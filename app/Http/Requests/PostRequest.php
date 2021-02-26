<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;  # !auth()->check()
    }

    public function rules()
    {
        return [
            'title'       => 'required',
            'body'        => 'required',
            'image'       => 'required',
            'category_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required'         => 'you must insert title',
            'body.required'          =>'body is requierd ....',
            'image.required'         =>'you must insert image',
            'category_id.required'   => 'category required ..',

        ];

    }
}
