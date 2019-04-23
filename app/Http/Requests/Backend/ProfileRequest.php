<?php

namespace App\Http\Requests\Backend;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'height' => ['required'],
            'user_id' => 'required|integer|exists:users,id',
            'weight' => ['required'],
            'age' => ['required'],
            'gender' => ['required'],
            'contact' => ['required'],
            'plan' => ['required'],
            'avatar' => ['nullable', 'image'],

        ];
    }
}
