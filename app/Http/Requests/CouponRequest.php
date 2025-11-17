<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $couponId = $this->route('coupon')?->id;

        return [
            'title' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:coupons,code,' . $couponId,
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric|min:0',
            'status' => 'nullable|boolean',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after_or_equal:valid_from',
        ];
    }
}
