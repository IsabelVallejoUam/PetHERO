<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class UserRequest extends FormRequest
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
            'name' => 'required|max:128',
            'email' => 'required|max:256|email',
            'newpassword' => 'required_with:newpasswordconfirmation|max:256',
            'newpasswordconfirmation' => 'required_with:newpassword|same:newpassword',    
            'lastname' => 'required|max:256',
            'document'=> 'required|numeric|digits_between:8,10',
            'phone' => 'required|numeric|digits_between:7,10',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
