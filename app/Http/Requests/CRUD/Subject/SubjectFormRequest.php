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
            'name' => ['required', 'max:40'],
            'group_id' => ['required'],
            'students' => ['required', 'array', 'min:1'],
            'academic_grade' => ['required', 'array', 'min:1'],
            'students.*' => ['required', 'string', 'max:40'],
            'academic_grade.*' => ['required', 'integer', 'between:1,5', 'min:1'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.custom.name.required'),
            'group_id.required' => __('validation.custom.group_id.required'),
            'name.max:40' => __('validation.custom.name.max:40'),
            'academic_grade.*.between' => __('validation.custom.academic_grade_item.between'),
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
