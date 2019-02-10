<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AreaStoreRequest extends FormRequest
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
            'name' => 'required|unique:areas,name',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'La area ya ha sido registrada',
            'name.required' => 'El campo no puede estar vacio',
            
        ];
    }
}
