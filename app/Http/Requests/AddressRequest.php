<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    public function authorize()
    {
        // Admin middleware handles authorization
        return true;
    }

    public function rules()
    {
        return [
            'type' => 'required|in:billing,shipping',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'Address type is required.',
            'type.in' => 'Type must be either billing or shipping.',
            'address_line1.required' => 'Address Line 1 is required.',
            'city.required' => 'City is required.',
            'country.required' => 'Country is required.',
        ];
    }
}
