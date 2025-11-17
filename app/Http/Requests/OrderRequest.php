<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'shipping_address' => 'nullable|string|max:500',
            'billing_address' => 'nullable|string|max:500',
            'status' => 'required|in:pending,processing,completed,cancelled',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'transaction.transaction_id' => 'nullable|string',
            'transaction.amount' => 'nullable|numeric',
            'transaction.payment_method' => 'nullable|in:cash,card,upi,wallet',
            'transaction.status' => 'nullable|in:pending,completed,failed',
        ];
    }
}
