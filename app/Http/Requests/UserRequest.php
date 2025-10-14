<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $userId = $this->route('user') ? $this->route('user')->id : null;

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email' . ($userId ? ',' . $userId : ''),
            'phone' => 'required|string|unique:users,phone' . ($userId ? ',' . $userId : ''),
            'password' => $userId ? 'nullable|string|min:8|confirmed' : 'required|string|min:8|confirmed',
        ];
    }
}
