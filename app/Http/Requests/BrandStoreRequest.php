<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandStoreRequest extends FormRequest
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
            'title' => 'required|unique:brands,title',
        ];
    }

    public function messages()
    {
        return [
            'title.unique' => 'La marca ya ha sido registrada',
            'title.required' => 'El campo no puede estar vacio',
            
        ];
    }

}
