<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'ci'         => 'required|unique:users,ci|min:7|max:8',
            'first_name' => 'required|regex:/^[a-zA-Z\s]*$/|max:128',
            'last_name'  => 'required|regex:/^[a-zA-Z\s]*$/|max:128',
            'gender'     => 'required|in:M,F',
        ];
    }

    public function messages()
    {
        return [
            'ci.required' => 'El campo no puede estar vacio.',
            'ci.regex' => 'La cedula solo debe contener numeros.',
            'ci.min' => 'La cedula debe tener minimo :min caracteres.',
            'ci.max' => 'La cedula debe tener maximo :max caracteres.',
            'first_name.regex' =>'El nombre solo puede contener letras.',
            'last_name.regex' => 'El apellido solo puede contener letras.',
            'first_name.required' =>'El campo no puede estar vacio.',
            'last_name.required' => 'El campo no puede estar vacio.',
        ];
    }
}
