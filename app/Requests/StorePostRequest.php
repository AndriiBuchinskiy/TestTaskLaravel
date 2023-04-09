<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;
class StorePostRequest extends FormRequest
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
        ];
    }

    public function messages(): array
    {
        return [
            'title.*' => 'Field name is required, minimum length 3 characters',
            'content.*' => 'Minimum length of description 3 characters, maximum 1000 ',
            'category_id.*' => 'Field categories must be an integer',
        ];
    }
}