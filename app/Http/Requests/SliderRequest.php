<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'             => 'required|string|max:255',
            'subtitle'          => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string',
            'image'             => 'nullable|image|max:2048',
            'image_alt'         => 'nullable|string|max:255',
            'button_text'       => 'nullable|string|max:255',
            'button_link'       => 'nullable|url|max:255',
            'position'          => 'nullable|integer',
            'custom_field'      => 'nullable|string',
            'status'            => 'required|boolean',
        ];
    }
}
