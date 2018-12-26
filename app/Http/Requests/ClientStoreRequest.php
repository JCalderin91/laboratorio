<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientStoreRequest extends FormRequest
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
            'ci'         => 'required|unique:clients,ci|max:8',
            'first_name' => 'required|max:128',
            'last_name'  => 'required|max:128',
            'phone'      => 'max:11',
            'area_id'    => 'required',
        ];
    }
}
