<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\LogRequest;
use App\Http\Requests\RegistrationRequest;

class LogController extends Controller
{
    public function getHome()
    {
        return view('index');
    }
    public function loginForm()
    {
        return view('log.login');
    }

    public function registrationForm()
    {
        return view("log.register");
    }

    public function postLogin(LogRequest $request)
    {
        $password = $request->get("password");
        $email = $request->get("email");

        if (Auth::attempt(["email" => $email, "password" => $password]))
        {
            return redirect()->route("profiles.home");         
        }

        else
        {
            return redirect()->route("login")->withError("Email Or Password Mismatched");
        }
    }

    public function postRegistration(RegistrationRequest $request)
    {
        $user = new User;
        $user->first_name = $request->get("firstname");
        $user->last_name = $request->get("lastname");
        $user->email = $request->get("email");
        $user->password = $request->get("password");
        //dd($user);
        //exit;
        $user->save();
        return redirect()->route("login");
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("login");
    }
}
