<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;

class UserRequest extends Request
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
        $routeUserId = $this->route('user');
        $userId = $routeUserId ? $routeUserId->id : null;

        $rules = [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.$userId,
        ];

        if (!$userId) {
            $rules['password'] = 'required|min:6|confirmed';
        }
        
        return $rules;
    }
}
