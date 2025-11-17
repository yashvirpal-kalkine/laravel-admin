<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculatorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('calculator')?->id;

        return [
            'title' => ['required', 'string', 'max:255'],

            // slug optional — it can be auto-generated if empty
            'slug' => ['nullable', 'string', 'max:255', 'unique:calculators,slug,' . $id],

            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],

            // ✅ Accept actual file uploads
            'banner' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,avif', 'max:2048'],
            'banner_alt' => ['nullable', 'string', 'max:255'],

            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,avif', 'max:2048'],
            'image_alt' => ['nullable', 'string', 'max:255'],

            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_keywords' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'seo_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,avif', 'max:2048'],
            'canonical_url' => ['nullable', 'url', 'max:255'],

            'status' => ['boolean'],
            'author_id' => ['nullable', 'exists:admins,id'],
            'custom_field' => ['nullable', 'string', 'max:255'],

            // ✅ FAQ: array of {question, answer}
            'faqs' => ['nullable', 'array'],
            'faqs.*.question' => ['required_with:faqs.*.answer', 'string', 'max:500'],
            'faqs.*.answer' => ['required_with:faqs.*.question', 'string'],
            
            'form_type' => ['nullable', 'string', 'max:255'],
        ];
    }
}
