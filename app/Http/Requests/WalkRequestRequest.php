<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class WalkRequestRequest extends FormRequest
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
            'requested_day' => 'required|max:128|date',
            'minutes_walked' => 'required|max:128|digits_between:0,480',
           // 'route' => 'required|max:128',
            'min_time' => 'required|max:128|digits_between:0,480',
            'max_time' => 'required|max:128|digits_between:1,480',
            'commentary' => 'required|max:128',
            'status' => 'required',
            'walker' => 'required',
 
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
