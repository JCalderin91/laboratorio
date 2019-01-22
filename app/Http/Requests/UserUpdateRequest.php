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
            'ci'         =>  Rule::unique('users')->ignore($this->user),
            'first_name' => 'max:128',
            'last_name'  => 'max:128',
            'gender'     => 'in:M,F',
            'admin' => 'in:' . User::USER_REGULAR . ',' . User::USER_ADMIN, 
        ];
    }
}
