<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


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
            'price' => 'required|numeric|min:100',
            'title' => 'required|max:256',
            'discount' => 'required|numeric|digits_between:0,100',         
            'quantity' => 'required|numeric',
            'description'=> 'required|max:400',
            'image_url' => 'max:256',


        ];
    }

}
