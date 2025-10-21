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
            // ✅ GENERAL SETTINGS
            'general.favicon' => 'nullable|file|image|max:1024',
            'general.header_logo' => 'nullable|file|image|max:2048',
            'general.footer_logo' => 'nullable|file|image|max:2048',
            'general.currency' => 'nullable|string|max:10',
            'general.email' => 'nullable|email:rfc,dns',
            'general.email2' => 'nullable|email:rfc,dns',
            'general.phone' => 'nullable|string|max:20',
            'general.phone2' => 'nullable|string|max:20',
            'general.address' => 'nullable|string',
            'general.map' => 'nullable|string',

            // ✅ SMTP SETTINGS
            'smtp.host' => 'nullable|string|max:255',
            'smtp.port' => 'nullable|integer',
            'smtp.username' => 'nullable|string|max:255',
            'smtp.password' => 'nullable|string|max:255',
            'smtp.from' => 'nullable|string|max:255',

            // ✅ SCRIPT SETTINGS
            'script.head' => 'nullable|string',
            'script.body' => 'nullable|string',
            'script.footer' => 'nullable|string',

            // 💳 PAYMENT SETTINGS
            'payment_gateway' => 'nullable|array',
            'payment_gateway.*.enabled' => 'nullable|boolean',
            'payment_gateway.*.merchant_id' => 'nullable|string|max:255',
            'payment_gateway.*.secret_key' => 'nullable|string|max:255',
            'payment_gateway.*.webhook_key' => 'nullable|string|max:255',
            'payment_gateway.*.webhook_url' => 'nullable|url',

            // ✅ SOCIAL SETTINGS
            'social' => 'nullable|array',
            'social.*' => 'nullable|string|max:255',
        ];
    }
}
