<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;
class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|min:3|max:255',
            'content' => 'nullable|string|min:3|max:1000',
            'category_id' => 'nullable|integer|exists:App\Models\Category,id',
            'tags' => 'nullable|array',
            'image' => 'nullable|image|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Поле не повинно бути пустим',
            'title.min' => 'Поле повинно мати не менше 3 символів',
            'title.max' => 'Поле повинно мати не більше 100 символів',
            'content.required' => 'Поле контент не повинно бути пустим.',
            'content.min' => 'Довжина має бути не менше 3 символів',
            'content.max' => 'Довжина має бути не більше 255 символів',
            'category_id.*' => 'Field categories must be an integer',
            'tags.*' => 'Filed is not null',
            'image.*' => 'Incorrect size image'
        ];
    }
}