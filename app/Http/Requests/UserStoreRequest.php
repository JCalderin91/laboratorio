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
            'id'         => 'required|unique:users,id|max:8',
            'first_name' => 'required|max:128',
            'last_name'  => 'required|max:128',
            'gender'     => 'required|in:M,F',
            'password'   => 'required',
            'role_id'    => 'required'
        ];
    }
}