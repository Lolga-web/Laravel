<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResourceRequest extends FormRequest
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
        return [
            'title' => "required|unique:resources,title|max:30",
            'url' => "required|url|unique:resources,url",
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Не заполнено :attribute',
            'title.unique' => 'Такое :attribute уже существует',
            'title.max' => 'В поле :attribute должно быть не больше 30 символов',
            'url.url' => 'Некорректный :attribute',
            'url.required' => 'Не заполнен :attribute',
            'url.unique' => 'Такой :attribute уже существует',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Название ресурса',
            'url' => 'Адрес ресурса',
        ];
    }
}
