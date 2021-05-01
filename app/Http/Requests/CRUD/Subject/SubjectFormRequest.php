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
            'name'     => ['required', 'max:40'],
            'group_id' => ['required'],
            'student'  => ['required', 'max:40'],
            'value'    => ['required', 'numeric', 'max:5', 'min:1'],
        ];
    }
    public function messages()
    {
        return [
            'name.required'     => __('validation.custom.name.required'),
            'group_id.required' => __('validation.custom.group_id.required'),
            'name.max:40'       => __('validation.custom.name.max:40'),
            'student.required'  => __('validation.custom.student.required'),
            'student.max:40'    => __('validation.custom.student.max:40'),
            'value.required'    => __('validation.custom.value.required'),
            'value.max:5'       => __('validation.custom.value.max:5'),
            'value.min:1'       => __('validation.custom.value.min:1'),
            'value.numeric'     => __('validation.custom.value.numeric')
        ];
    }

    public function attributes()
    {
        return [
          'value' => __('validation.attributes.value')
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
