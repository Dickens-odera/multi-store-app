<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverRequest extends FormRequest
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
            'name' => 'required|unique:drivers,name|string|min:3|max:20',
            'email' => 'required|unique:drivers,email|string|min:5|max:60',
            'phone' => 'required|unique:drivers,phone|string|min:5|max:20',
            'vehicle_type' => 'required|exists:vehicle_types,id|integer'
        ];
    }
}
