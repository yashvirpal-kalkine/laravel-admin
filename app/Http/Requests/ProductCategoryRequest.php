<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('product_category')?->id;

        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:product_categories,slug,' . $id,
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'banner' => 'nullable|image|max:2048',
            'alt' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'status' => 'nullable|boolean',
            'parent_id' => 'nullable|exists:product_categories,id',
        ];
    }
}
