<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $postId = $this->route('blog_post')?->id;

        return [
            // Basic info
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_posts,slug,' . $postId,

            // Relationships
            'categories' => 'nullable|array',
            'categories.*' => 'exists:blog_categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:blog_tags,id',

            // Content
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',

            // Images
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'banner_alt' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'image_alt' => 'nullable|string|max:255',

            // SEO
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'seo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'canonical_url' => 'nullable|url|max:255',

            // Misc
            'custom_field' => 'nullable|string|max:255',
            'is_featured' => 'nullable|boolean',
            'status' => 'nullable|boolean',
            'published_at' => 'nullable|date',

            // Authorship
            'author_id' => 'nullable|exists:admins,id',
        ];
    }
}
