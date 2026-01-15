<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Support\Collection;

class CouponService
{
    protected Cart $cart;
    protected ?Coupon $coupon = null;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Apply a coupon by code
     */
    public function apply(string $code): bool
    {
        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon || !$coupon->isActive()) {
            return false; // Invalid coupon
        }

        if (!$this->rulesSatisfied($coupon)) {
            return false; // Rules not satisfied
        }

        $this->coupon = $coupon;

        $this->applyActions($coupon->actions);

        return true;
    }

    /**
     * Check if rules are satisfied
     */
    protected function rulesSatisfied(Coupon $coupon): bool
    {
        foreach ($coupon->rules as $rule) {
            switch ($rule->condition) {
                case 'product':
                    $item = $this->cart->items()->where('product_id', $rule->product_id)->first();
                    if (!$item || $item->quantity < $rule->min_qty)
                        return false;
                    break;

                case 'category':
                    $items = $this->cart->items()->whereHas('product', function ($q) use ($rule) {
                        $q->where('category_id', $rule->category_id);
                    })->get();

                    $qty = $items->sum('quantity');
                    if ($qty < $rule->min_qty)
                        return false;
                    break;

                case 'cart_subtotal':
                    if ($this->cart->subtotal < $rule->min_value)
                        return false;
                    break;

                case 'cart_quantity':
                    $totalQty = $this->cart->items()->sum('quantity');
                    if ($totalQty < $rule->min_qty)
                        return false;
                    break;
            }
        }

        return true;
    }

    /**
     * Apply all actions
     */
    protected function applyActions($actions)
    {
        foreach ($actions as $action) {
            switch ($action->action) {
                case 'fixed_discount':
                    $this->cart->discount_total += $action->value;
                    break;

                case 'percentage_discount':
                    $this->cart->discount_total += ($this->cart->subtotal * $action->value / 100);
                    break;

                case 'free_product':
                    $this->addFreeProduct($action->product_id, $action->quantity);
                    break;

                case 'discount_product':
                    $this->discountProduct($action->product_id, $action->value);
                    break;
            }
        }

        $this->recalculateCart();
    }

    /**
     * Add free product (BOGO)
     */
    protected function addFreeProduct(int $productId, int $quantity)
    {
        $item = $this->cart->items()->where('product_id', $productId)->first();

        if ($item) {
            $item->quantity += $quantity;
            $item->price = $item->price; // Price remains same
            $item->save();
        } else {
            $this->cart->items()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => 0, // Free product
            ]);
        }
    }

    /**
     * Discount a specific product
     */
    protected function discountProduct(int $productId, float $value)
    {
        $item = $this->cart->items()->where('product_id', $productId)->first();
        if ($item) {
            $item->price -= $value;
            if ($item->price < 0)
                $item->price = 0;
            $item->save();
        }
    }

    /**
     * Recalculate cart totals
     */
    protected function recalculateCart()
    {
        $subtotal = $this->cart->items->sum(function ($i) {
            return $i->price * $i->quantity;
        });

        $this->cart->subtotal = $subtotal;
        $this->cart->grand_total = max(
            0,
            $subtotal - $this->cart->discount_total + $this->cart->tax_total + $this->cart->shipping_total
        );

        $this->cart->save();
    }

    /**
     * Return applied coupon
     */
    public function getCoupon(): ?Coupon
    {
        return $this->coupon;
    }
}
