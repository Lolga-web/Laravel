<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Category;

class CategoryRequest extends FormRequest
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
            'title' => "required|max:50",
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Не заполнено :attribute',
            'title.max' => 'В поле :attribute должно быть не больше 50 символов',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Название категории'
        ];
    }
}
