<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
            'post_id'=>'required|integer|exists:posts,id',
            'content' => 'required|min:3|max:3000|string',
            //'user_id'=>'required|integer|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [

            'post_id.exists' => 'Поле айді має існувати',
            'content.required' => 'Поле тексту коментаря є обов\'язковим',
            'content.min' => 'Поле тексту коментаря повинно бути не менше 3-х символів',
            'content.max' => 'Поле тексту коментаря повинно бути не більше 3000 символів',
            'content.string' => 'Поле тексту коментаря повинно складатися з букв',

        ];
    }
}