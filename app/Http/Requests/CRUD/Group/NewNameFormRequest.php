<?php

namespace App\Http\Requests\CRUD\Group;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class NewNameFormRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:20'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле должно быть заполнено!',
            'name.string' => 'Поле должно быть строкой!',
            'name.max:20' => 'Поле не должно быть длиннее 20 символов!'
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
