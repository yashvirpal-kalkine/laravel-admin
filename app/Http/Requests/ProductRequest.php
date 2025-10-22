<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('product')?->id;

        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug,' . $id,
            'sku' => 'nullable|string|max:100|unique:products,sku,' . $id,
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'is_featured' => 'boolean',
            'status' => 'nullable|boolean',
            'product_category_ids' => 'nullable|array',
            'product_category_ids.*' => 'exists:product_categories,id',
            'product_tag_ids' => 'nullable|array',
            'product_tag_ids.*' => 'exists:product_tags,id',
        ];
    }
}
