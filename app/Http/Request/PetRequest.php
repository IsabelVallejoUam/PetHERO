<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class PetRequest extends FormRequest

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
        
        'name' => 'requiered|max:50',
        'sex'=> 'requiered',
        'birthday' => 'requiered|date',
        'race'  => 'requiered|max:100',
        'personality' => 'requiered',
        'commentary' => 'max:200',
        'size'  => 'requiered',

        ];
    }
    
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
