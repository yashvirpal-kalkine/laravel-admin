<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'favicon' => 'nullable|file|image|max:1024',
            'header_logo' => 'nullable|file|image|max:2048',
            'footer_logo' => 'nullable|file|image|max:2048',
            'currency' => 'nullable|string|max:10',
            'email' => 'nullable|email:rfc,dns',
            'email2' => 'nullable|email:rfc,dns',
            'phone' => 'nullable|string|max:20',
            'phone2' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'map' => 'nullable|string',

            'payment_gateway' => 'nullable|array',
            'payment_gateway.*' => 'nullable|string',


            'smtp_host' => 'nullable|string|max:255',
            'smtp_port' => 'nullable|integer',
            'smtp_username' => 'nullable|string|max:255',
            'smtp_password' => 'nullable|string|max:255',
            'smtp_from' => 'nullable|string|max:255',

            'head_script' => 'nullable|string',
            'body_script' => 'nullable|string',
            'footer_script' => 'nullable|string',            
            'footer_content' => 'nullable|string',

            'social' => 'nullable|array',

        ];
    }
}
