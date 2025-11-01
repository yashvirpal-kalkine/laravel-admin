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
        $id = $this->route('product');
        $id = is_object($id) ? $id->id : $id;

        return [
            // Basic Info
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug,' . $id,
            'sku' => 'nullable|string|max:100|unique:products,sku,' . $id,

            // Pricing
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:regular_price',

            // Inventory
            'stock' => 'required|integer|min:0',

            // Descriptions
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',

            // ✅ Image uploads (files or existing strings)
            'banner' => 'nullable|sometimes|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_alt' => 'nullable|string|max:255',
            'image' => 'nullable|sometimes|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_alt' => 'nullable|string|max:255',
            'seo_image' => 'nullable|sometimes|image|mimes:jpg,jpeg,png,webp|max:2048',

            // SEO fields
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'canonical_url' => 'nullable|url|max:255',

            // Misc
            'custom_field' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'status' => 'boolean',

            // Relations
            'brand_id' => 'nullable|exists:brands,id',
            'product_category_ids' => 'nullable|array',
            'product_category_ids.*' => 'exists:product_categories,id',
            'product_tag_ids' => 'nullable|array',
            'product_tag_ids.*' => 'exists:product_tags,id',

            // ✅ Gallery validation
            'gallery' => 'nullable|array',
            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery_alt.*' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'slug.unique' => 'This slug is already used for another product.',
            'sku.unique' => 'This SKU already exists. Please choose another.',
            'sale_price.lt' => 'Sale price must be less than regular price.',
            'canonical_url.url' => 'Please enter a valid canonical URL.',
            'banner.image' => 'The banner must be a valid image file.',
            'image.image' => 'The main image must be a valid image file.',
            'seo_image.image' => 'The SEO image must be a valid image file.',
        ];
    }
}
