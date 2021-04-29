<?php

namespace App\Http\Requests\CRUD\Subject;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class SubjectFormRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:40'],
            'group_id' => ['required'],
            'student' => ['required', 'string', 'max:40'],
            'value' => ['required', 'numeric', 'max:5', 'min:1'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Поле должно быть заполнено!',
            'group_id.required' => 'Поле должно быть заполнено!',
            'name.string' => 'Поле должно быть строкой!',
            'name.max' => 'Поле не должно быть не длиннее 40 символов!',
            'student.required' => 'Поле должно быть заполнено!',
            'student.string' => 'Поле должно быть строкой!',
            'student.max' => 'Поле не должно быть не длиннее 40 символов!',
            'value.required' => 'Поле должно быть заполнено!',
            'value.max' => 'Оценка не может быть больше 5 (пяти) баллов!',
            'value.min' => 'Оценка не может быть меньше 1 (одного) бала!',
            'value.numeric' => 'Поле должно быть числом!'
        ];
    }

    public function attributes()
    {
        return [
          'value' => 'оценка по предмету'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        if (count($errors) > 0) {
            response()->json(
                ['message' => $errors->first()], 422
            );
        }
    }
}
