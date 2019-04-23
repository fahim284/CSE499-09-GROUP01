<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'firstname' => 'required|between: 1,255',
            'lastname' => 'required|between: 1,255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:30|confirmed'
        ];
    }
}
