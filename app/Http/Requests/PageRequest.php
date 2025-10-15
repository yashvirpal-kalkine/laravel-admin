<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Update based on auth logic
    }

    public function rules(): array
    {
        $pageId = $this->route('page')?->id;

        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $pageId,
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'alt' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'seo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'canonical_url' => 'nullable|url|max:255',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'author_id' => 'nullable|exists:users,id',
        ];
    }
}
