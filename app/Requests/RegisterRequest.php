<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'=>'required|string',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation'=>'required',
            'device_name' => 'required',
        ];
    }
}