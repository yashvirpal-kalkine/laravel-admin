<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GlobalSectionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('global_section')?->id;

        return [
            'title'            => 'required|string|max:255',
            'slug'             => 'nullable|string|max:255|unique:global_sections,slug,' . $id,
            'short_description'=> 'nullable|string|max:500',
            'description'      => 'nullable|string',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_alt'        => 'nullable|string|max:255',
            'button_text'      => 'nullable|string|max:255',

            // domain URL validation
            'button_link' => [
                'nullable',
                'max:255',
                'regex:/^(https?:\/\/)?([a-z0-9-]+\.)+[a-z]{2,}(\/.*)?$/i'
            ],

            'template'         => 'nullable|string|max:255',
            'page_id'          => 'nullable|numeric|exists:pages,id',
            'custom_field'     => 'nullable|string',
            'status'           => 'required|boolean',
        ];
    }
}
