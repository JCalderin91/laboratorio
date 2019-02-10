<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BrandUpdateRequest extends FormRequest
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
            'title' => Rule::unique('brands')->ignore($this->brand),
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
