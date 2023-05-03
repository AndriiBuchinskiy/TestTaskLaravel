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
        //dd($this->all());
        return [
            'title' => 'required|string|min:3|max:100',
            'content' => 'required|string|min:3|max:255',
            //'category' => 'required|integer|exists:categories,id',
            'img_path' => 'nullable|mimes:jpeg,png|max:2048',
            //'tags' => 'required|string' ,
            //'tags' => 'required|min:1',
            //'tags.*' => 'required|,
            //'tags' => 'nullable|array',
            //'tags.*' => 'exists:tags,id',
            //'title' => 'sometimes|required|string|min:3|max:255',
            //'content' => 'nullable|string|min:3|max:1000',
            //'category_id' => 'nullable|integer|exists:App\Models\Category,id',
            //'tag_id' => 'integer|exists:App\Models\Tag,id'
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
            'category.required' => 'Категорія не вибрана.',
            //'tags.array' => 'The tags must be an array.',
            'tags.*' => 'The selected tag is invalid.',
            'category_id.integer' => 'Некоректна категорія',
            //'tags.exists' => 'Не вибрані теги',
            'img_path.mimes' => 'Формат зображення повинен бути jpeg або png.',
            'img_path.max' => 'Розмір файлу зображення не повинен перевищувати 2048 кб.',
            //'title.required' => 'Поле не повинно бути пустим',
            //'title.min' => 'Поле повинно мати не менше 3 символів',
            //'title.max' => 'Поле повинно мати не більше 255 символів',
            //'content.min' => 'Довжина має бути не менше 3 символів',
            //'content.max' => 'Довжина має бути не більше 255 символів',
            //'category_id.exists' => 'Не вибрана категорія',
            //'
            //
            //'tag_id.integer' => 'Некоректні теги',
        ];
    }
}