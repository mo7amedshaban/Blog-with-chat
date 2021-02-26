<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function authorize()
    {
        return !auth()->check();
    }


    public function rules()
    {
        return [
            'name' =>'required',
            'email' => 'required|email',
            'password' => 'required',
            //'device_name' =>'required',

        ];

    }
    public function messages()
    {
        return [
            'name.required' => 'you must insert name',
            'email.required' =>'email is requierd ....',
            'email.email'=>'you must insert email',
            'password.required' => 'password required ..',

        ];

    }
}
