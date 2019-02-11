<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'ci'         =>  ['required','regex:/^[0-9]*$/','min:7', 'max:10',  Rule::unique('users')->ignore($this->user)],
            'first_name' => 'required|regex:/^[a-zA-Z\s]*$/|max:128',
            'last_name'  => 'required|regex:/^[a-zA-Z\s]*$/|max:128',
            'gender'     => 'in:M,F',
            'admin' => 'in:' . User::USER_REGULAR . ',' . User::USER_ADMIN, 
        ];
    }

    public function messages()
    {
        return [
            'ci.required' => 'El campo no puede estar vacío.',
            'ci.unique' => 'La cedula ya ha sido registrada',
            'ci.regex' => 'La cedula solo debe contener numeros.',
            'ci.min' => 'La cedula debe tener minimo :min caracteres.',
            'ci.max' => 'La cedula debe tener maximo :max caracteres.',
            'first_name.regex' =>'El nombre solo puede contener letras.',
            'last_name.regex' => 'El apellido solo puede contener letras.',
            'first_name.required' =>'El campo no puede estar vacío.',
            'last_name.required' => 'El campo no puede estar vacío.',
        ];
    }
}
