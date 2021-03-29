<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $tableNameCategory = (new Category())->getTable();
        return [
            'title' => 'required|min:10|max:100',
            'text' => 'required',
            'category_id' => "required|exists:{$tableNameCategory},id",
            'isPrivate' => 'in:null,1',
            'image' => 'mimes:jpeg,png,bmp|max:1000'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Не заполнено поле :attribute',
            'title.min' => 'В поле :attribute должно быть не меньше 30 символов',
            'title.max' => 'В поле :attribute должно быть не больше 100 символов',
            'text.required' => 'Не заполнено поле :attribute',
            'category_id.required' => 'Не заполнено поле :attribute',
            'isPrivate.in' => 'Недопустимое значение поля :attribute',
            'image.mimes' => ':attribute должен быть в формате jpeg, png или bmp',
            'image.max' => ':attribute не должно быть больше 1Мб',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Заголовок новости',
            'text' => 'Текст новости',
            'category_id' => 'Категория новости',
            'isPrivate' => 'Приватность',
            'image' => 'Изображение'
        ];
    }

}

