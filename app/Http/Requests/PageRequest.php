<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $pageId = $this->route('page')?->id;

        return [
            'title' => 'required|string|max:255',

            // Allow slug to be empty → auto generated
            'slug' => 'nullable|string|max:255|unique:pages,slug,' . $pageId,

            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',

            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'alt' => 'nullable|string|max:255',

            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'seo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',

            'canonical_url' => 'nullable|url|max:255',

            // Must match your DB logic (boolean 1/0)
            'status' => 'required|boolean',

            // ✅ Correct relation (page belongs to admin)
            'author_id' => 'nullable|exists:admins,id',

            // ✅ Correct self relation (page to parent page)
            'parent_id' => 'nullable|exists:pages,id',

            'template' => 'nullable|string|in:' . implode(',', array_keys(config('settings.templates'))),
            'custom_field' => 'nullable|string|max:255',
        ];
    }
}
