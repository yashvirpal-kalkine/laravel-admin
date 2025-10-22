<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'slug' => 'required|string|max:255|unique:blog_tags,slug,' . $tagId,
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'alt' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'status' => 'nullable|boolean',
            'author_id' => 'nullable|exists:users,id',
        ];
    }
}
