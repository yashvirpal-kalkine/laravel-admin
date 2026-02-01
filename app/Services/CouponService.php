<?php

namespace App\Services;

use App\Models\Coupon;
use Illuminate\Support\Collection;

class CouponService
{
    protected ?Coupon $coupon = null;

    /**
     * Load a coupon by code.
     */
    public function load(string $code): ?self
    {
        $this->coupon = Coupon::with('rules.product', 'rules.category', 'actions.product')
            ->where('code', $code)
            ->first();
        return $this;
    }

    /**
     * Check if coupon is valid (active, within dates, usage limits)
     */
    public function isValid(): bool
    {
        if (!$this->coupon)
            return false;

        if (!$this->coupon->status)
            return false;
        if ($this->coupon->starts_at && now()->lt($this->coupon->starts_at))
            return false;
        if ($this->coupon->expires_at && now()->gt($this->coupon->expires_at))
            return false;
        if ($this->coupon->usage_limit && $this->coupon->used_count >= $this->coupon->usage_limit)
            return false;

        return true;
    }

    /**
     * Check if cart meets all coupon rules
     * 
     * $cartItems = [
     *   ['product_id' => 1, 'category_id' => 5, 'price' => 500, 'qty' => 2],
     *   ...
     * ]
     */
    protected function meetsRules(array $cartItems): bool
    {
        if ($this->coupon->rules->isEmpty()) {
            return true; // No rules = always applicable
        }

        foreach ($this->coupon->rules as $rule) {
            if (!$this->checkRule($rule, $cartItems)) {
                return false; // All rules must pass
            }
        }

        return true;
    }

    /**
     * Check individual rule
     */
    protected function checkRule($rule, array $cartItems): bool
    {
        switch ($rule->condition) {
            case 'product':
                // Check if specific product exists in cart
                foreach ($cartItems as $item) {
                    if ($item['product_id'] == $rule->product_id) {
                        // Check min qty if specified
                        if ($rule->min_qty && $item['qty'] < $rule->min_qty) {
                            return false;
                        }
                        return true;
                    }
                }
                return false;

            case 'category':
                // Check if any product from specific category exists in cart
                foreach ($cartItems as $item) {
                    if (isset($item['category_id']) && $item['category_id'] == $rule->category_id) {
                        // Check min qty if specified
                        if ($rule->min_qty && $item['qty'] < $rule->min_qty) {
                            return false;
                        }
                        return true;
                    }
                }
                return false;

            case 'cart_subtotal':
                // Check if cart subtotal meets minimum
                $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['qty'], $cartItems));
                return $subtotal >= ($rule->min_value ?? 0);

            case 'cart_quantity':
                // Check if total cart quantity meets minimum
                $totalQty = array_sum(array_column($cartItems, 'qty'));
                return $totalQty >= ($rule->min_qty ?? 0);

            default:
                return false;
        }
    }

    /**
     * Apply coupon to a cart
     * 
     * $cartItems = [
     *   ['product_id' => 1, 'category_id' => 5, 'price' => 500, 'qty' => 2],
     *   ...
     * ]
     */
    public function apply(array $cartItems): array
    {
        if (!$this->coupon || !$this->isValid()) {
            return [
                'success' => false,
                'message' => 'Coupon is invalid or expired.',
                'discount' => 0,
                'free_items' => [],
            ];
        }

        // Check if cart meets coupon rules
        if (!$this->meetsRules($cartItems)) {
            return [
                'success' => false,
                'message' => 'Cart does not meet coupon requirements.',
                'discount' => 0,
                'free_items' => [],
            ];
        }

        $discount = 0;
        $freeItems = [];

        foreach ($this->coupon->actions as $action) {

            switch ($action->action) {

                case 'fixed_discount':
                    $discount += $this->calculateFixedDiscount($action, $cartItems);
                    break;

                case 'percentage_discount':
                    $discount += $this->calculatePercentageDiscount($action, $cartItems);
                    break;

                case 'discount_product':
                    $discount += $this->calculateProductDiscount($action, $cartItems);
                    break;

                case 'free_product':
                    $freeItems[] = [
                        'product_id' => $action->product_id,
                        'quantity' => $action->quantity ?? 1,
                    ];
                    break;

                case 'bogo':
                    $bogoFree = $this->calculateBogo($action, $cartItems);
                    if (!empty($bogoFree)) {
                        $freeItems = array_merge($freeItems, $bogoFree);
                    }
                    break;
            }
        }

        return [
            'success' => true,
            'message' => 'Coupon applied successfully.',
            'discount' => round($discount, 2),
            'free_items' => $freeItems,
        ];
    }

    /**
     * Fixed cart discount
     */
    protected function calculateFixedDiscount($action, array $cartItems): float
    {
        return $action->value ?? 0;
    }

    /**
     * Percentage cart discount
     */
    protected function calculatePercentageDiscount($action, array $cartItems): float
    {
        $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['qty'], $cartItems));
        return ($action->value / 100) * $subtotal;
    }

    /**
     * Discount on a specific product
     */
    protected function calculateProductDiscount($action, array $cartItems): float
    {
        $discount = 0;
        foreach ($cartItems as $item) {
            if ($item['product_id'] == $action->product_id) {
                $discount += ($item['price'] * $item['qty']) * ($action->value / 100);
            }
        }
        return $discount;
    }

    /**
     * BOGO logic (Buy X Get Y of the same product free)
     */
    protected function calculateBogo($action, array $cartItems): array
    {
        $freeItems = [];

        if (!$action->product_id || !$action->buy_qty) {
            return $freeItems;
        }

        foreach ($cartItems as $item) {
            if ($item['product_id'] == $action->product_id && $item['qty'] >= $action->buy_qty) {
                $times = intdiv($item['qty'], $action->buy_qty);
                $freeItems[] = [
                    'product_id' => $action->product_id,
                    'quantity' => $times * ($action->get_qty ?? 1),
                ];
            }
        }

        return $freeItems;
    }

    /**
     * Increment used count after successful checkout
     */
    public function markUsed(): void
    {
        if ($this->coupon) {
            $this->coupon->increment('used_count');
        }
    }

    /**
     * Get the loaded coupon
     */
    public function getCoupon(): ?Coupon
    {
        return $this->coupon;
    }
}