<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShirtOrderRequest extends FormRequest
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
            'customer_id' => 'sometimes|numeric|min:1', 
            'fabric_id'   => 'sometimes|numeric|min:1',
            'collar_size' => 'sometimes|numeric|min:0', 
            'chest_size'  => 'sometimes|numeric|min:0', 
            'waist_size'  => 'sometimes|numeric|min:0', 
            'wrist_size'  => 'sometimes|numeric|min:0'
        ];
    }
}
