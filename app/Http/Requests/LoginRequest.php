<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !auth()->check(); //false
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
            //'device_name'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'email is required',
            'email.email' => ' you must insert email',
            'password.required' => 'password is required',
        ];
    }
}
