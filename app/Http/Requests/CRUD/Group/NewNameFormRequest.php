<?php

namespace App\Http\Requests\CRUD\Group;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

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
            'name' => ['required', 'max:20'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.custom.name.required'),
            'name.max:20'   => __('validation.custom.name.max:20')
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
