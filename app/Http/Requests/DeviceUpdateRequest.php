<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeviceUpdateRequest extends FormRequest
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
            'sub_device_id' => 'required|integer', 
            'brand_id'      => 'required|integer',
            'client_id'     => 'required|integer',
            'b_n'           => 'string|nullable',
            'model'         => 'string|nullable',
        ];
    }
}
