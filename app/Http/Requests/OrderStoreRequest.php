<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
            'ci'          => 'required|regex:/^[0-9]*$/|min:7|max:10',
            'first_name' => 'required|regex:/^[a-zA-Z\s]*$/|max:128',
            'last_name'  => 'required|regex:/^[a-zA-Z\s]*$/|max:128',
            'phone'       => 'nullable|regex:/^[0-9]*$/|max:11|min:11',
            'area_id'     => 'required|integer',
            'address_id'     => 'required|integer',
            'description' => 'string|nullable',
            'user_id'     => 'required|integer',
            'device_id'     => 'nullable|integer',


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
            'phone.regex' => 'El telefono solo debe contener numeros.',
            'phone.max' => 'El telefono solo debe contener :max caracteres',
            'phone.min' => 'El telefono solo debe contener :min caracteres',
            'title.required' => 'El campo no puede estar vacio',
            
        ];
    }
    
}
