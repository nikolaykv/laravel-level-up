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
            'student' => ['required', 'string', 'max:40'],
            'value' => ['required', 'numeric', 'max:1'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Поле должно быть заполнено!',
            'name.string' => 'Поле должно быть строкой!',
            'name.max:40' => 'Поле не должно быть не длиннее 40 символов!',
            'student.required' => 'Поле должно быть заполнено!',
            'student.string' => 'Поле должно быть строкой!',
            'student.max:40' => 'Поле не должно быть не длиннее 40 символов!',
            'value.required' => 'Поле должно быть заполнено!',
            'value.max:1' => 'Поле не должно быть не длиннее 40 символов!',
            'value.numeric' => 'Поле должно быть числом!'
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
