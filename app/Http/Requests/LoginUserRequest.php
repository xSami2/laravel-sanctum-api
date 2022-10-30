<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;       //   Determine if the user need to be authorized to make this request.
                           // false == You Need to Provide Token for the Request
                           // True  ==   No Need for Token for this request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => ['required' , 'string' , 'email'],
            'password' => ['required' , 'string' ,  'min:6']
        ];
    }
}
