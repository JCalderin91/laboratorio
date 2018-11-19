<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientUpdateRequest extends FormRequest
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
         
            'ci'         => ['required', Rule::unique('clients')->ignore($this->client)],
            'first_name' => 'required|max:128',
            'last_name'  => 'required|max:128',
            'phone'      => 'max:11',
            'area_id'    => 'required',
        ];
    }
}
