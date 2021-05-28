<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'        => 'required|unique:products,name|min:3|max:60',
            'price'       => 'required|integer',
            'description' => 'required|string|min:5|max:255',
            'in_stock'    => 'required|integer',
            'avatar'      => 'required|mimes:jpg,png,svg,JPG,PNG,JPEG|max:2048',
            'store_id'    => 'required|exists:stores,id|integer'
        ];
    }
}
