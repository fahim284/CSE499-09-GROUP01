<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Hash;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request)
    {

        $password = $request->get('password');
        $email = $request->get('email');

      // Where to redirect once the user logged in?
        $intendedRoute = function_exists('redprint') && redprint() ? 'redprint.dashboard' : 'backend.dashboard';

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->intended(route($intendedRoute));
        }

        return redirect()->back()->withErrors([
        'email' => trans('auth.failed'),
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('backend.login.form');
    }

    public function getProfile()
    {
        return view('backend.profile.form')->with('user', auth()->user());
    }

    public function postProfile(Request $request)
    {
        $rules = [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255'
        ];

        if ($request->get('password')) {
            $rules['password'] = 'sometimes|min:6|max:25|confirmed';
        }

        $request->validate($rules);

        $user = auth()->user();
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        if ($request->get('password')) {
            $user->password = $request->get('password');
        }

        $user->save();

        return redirect()->back()->withSuccess('Profile Saved.');
    }
}
