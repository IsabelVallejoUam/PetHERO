<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class WalkRequest extends FormRequest
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
            'requested_day' => 'required|max:128',
            'route' => 'required',
            'min_time' => 'required|max:128',
            'max_time' => 'required|max:128',
            'commentary' => 'required|max:128',
            'status' => 'required',
            'walker' => 'required'
        ];
    }


}
