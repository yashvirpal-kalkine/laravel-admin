<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tagId = $this->route('blog_tag')?->id;

        return [
            'title' => 'required|string|max:255',

            // ✅ Slug unique rule, ignore current record
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('blog_tags', 'slug')->ignore($tagId),
            ],

            'parent_id' => 'nullable|exists:blog_categories,id',

            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',

            // Banner
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'banner_alt' => 'nullable|string|max:255',

            // Thumbnail
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'image_alt' => 'nullable|string|max:255',

            // SEO
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
            'seo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'canonical_url' => 'nullable|url|max:255',

            // Custom
            'custom_field' => 'nullable|string|max:255',

            // Status
            'status' => 'required|boolean',

            // Author
            'author_id' => 'nullable|exists:admins,id',
        ];
    }
}
