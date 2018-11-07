<?php

namespace App\Http\Requests;

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
           // 'id'         => 'required|max:8|unique:users,id,' . this->user,
            'first_name' => 'required|max:128',
            'last_name'  => 'required|max:128',
            'gender'     => 'required|in:M,F',
            //'role_id'    => 'required',
        ];
    }
}