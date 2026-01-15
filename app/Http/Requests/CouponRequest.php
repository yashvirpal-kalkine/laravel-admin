<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Allow all for admin
    }

    public function rules(): array
    {
        $couponId = $this->route('coupon')?->id;

        return [
            'title' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:coupons,code,' . $couponId,
            'type' => 'required|in:fixed,percentage',
            'value' => 'required_if:type,fixed,percentage|numeric|min:0',
            'status' => 'nullable|boolean',
            'starts_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:starts_at',
            'usage_limit' => 'nullable|integer|min:0',
            'min_cart_amount' => 'nullable|numeric|min:0',
            'max_discount_amount' => 'nullable|numeric|min:0',

            // Rules array validation
            'rules' => 'nullable|array',
            'rules.*.condition' => 'required|string|in:product,category,cart_subtotal,cart_quantity',
            'rules.*.product_id' => 'nullable|exists:products,id',
            'rules.*.category_id' => 'nullable|exists:categories,id',
            'rules.*.min_value' => 'nullable|numeric|min:0',
            'rules.*.min_qty' => 'nullable|integer|min:0',

            // Actions array validation
            'actions' => 'nullable|array',
            'actions.*.action' => 'required|string|in:fixed_discount,percentage_discount,free_product,discount_product',
            'actions.*.product_id' => 'nullable|exists:products,id',
            'actions.*.value' => 'nullable|numeric|min:0',
            'actions.*.quantity' => 'nullable|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'value.required_if' => 'The value field is required for fixed or percentage coupons.',
            'rules.*.condition.in' => 'Invalid rule condition selected.',
            'actions.*.action.in' => 'Invalid action selected.',
        ];
    }
}
