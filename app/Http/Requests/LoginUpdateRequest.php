<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LoginUpdateRequest extends FormRequest
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
            'password' => 'nullable|string|min:5',
            'username' => Rule::unique('logins')->ignore($this->account) 
        ];

    }

    public function messages()
    {
        return [
            'password.min' => 'La contraseña debe ser minimo de :min caracteres.',
            'username.unique' => 'El nombre de usuario ya ha sido registrado.',
        ];
    }
}
