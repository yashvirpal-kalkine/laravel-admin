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
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_posts,slug,' . $postId,
            'categories' => 'nullable|array',
            'categories.*' => 'exists:blog_categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:blog_tags,id',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'alt' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'author_id' => 'nullable|exists:users,id',
        ];
    }
}
