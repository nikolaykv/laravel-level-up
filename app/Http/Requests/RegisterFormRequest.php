<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
            'surname' => ['required', 'string', 'max:20'],
            'group_id' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }


    public function messages()
    {
        return [
            'group_id.required' => 'Поле "' . __('common.other.group') . '" не было выбрано!',
        ];
    }

    public function attributes()
    {
        return [
            'surname' => "\"" . __('common.other.surname') . "\"",
        ];
    }

}
