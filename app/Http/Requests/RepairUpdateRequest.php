<?php

namespace App\Http\Requests;

use App\Repair;
use Illuminate\Foundation\Http\FormRequest;

class RepairUpdateRequest extends FormRequest
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
            'user_id' => 'required', 
            'order_id' => 'required', 
            'status' => 'in:' . Repair::ORDER_REPAIRED . ',' . Repair::ORDER_WITHOUT_REPAIR, 
            'description' => 'string',
        ];
    }
}
