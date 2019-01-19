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
            'ci'          => 'required|min:7|max:8',
            'first_name' => 'required|regex:/^[a-zA-Z\s]*$/|max:128',
            'last_name'  => 'required|regex:/^[a-zA-Z\s]*$/|max:128',
            'phone'       => 'max:11',
            'area_id'     => 'required|integer',
            'address_id'     => 'required|integer',
            'description' => 'string|nullable',
            'user_id'     => 'required|integer',
            'device_id'     => 'nullable|integer',


        ];
    }
}
