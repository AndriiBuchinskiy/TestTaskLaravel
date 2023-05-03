<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255'

        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Field name is required',
            'name.min' => 'Minimum length of name is 3 characters ',
            'name.max' => 'Maximum length of name is 100 characters ',
        ];
    }
}