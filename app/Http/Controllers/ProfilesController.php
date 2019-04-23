<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Shahnewaz\Redprint\Traits\CanUpload;
use App\Http\Requests\Backend\ProfileRequest;

class ProfilesController extends Controller
{
    use CanUpload;

    public function home()
    {
        $user = auth()->user();
        $profile = Profile::where('user_id', auth()->user()->id)->get();
        if($profile->isEmpty())
        {
            return view('profiles.index')->with('user', $user)
                                        ->with('message', 'First Create Your Profile')
                                        ->with('bmr', '')
                                        ->with('suggested_bmr', '');
        }
        $person = Profile::where('user_id', auth()->user()->id)->first();
        $gender = $person->gender;

        if($gender == 'male')
        {
            $bmr = 66 + (13.7 * $person->weight) + (5 * $person->height) - (6.8 * $person->age);
            $bmr = $bmr * 1.2;
            
            if($person->plan == 1)
            {
                $suggested_bmr = $bmr - 500;
            }
            else
            {
                $suggested_bmr = $bmr + 200;    
            }
            
        }

        else
        {
            $bmr = 655 + (9.6 * $person->weight) + (1.8 * $person->height) - (4.7 * $person->age);
            $bmr = $bmr * 1.2;

            if($person->plan == 1)
            {
                $suggested_bmr = $bmr - 500;
            }

            else
            {
                $suggested_bmr = $bmr + 200;
            } 
        }

        return view('profiles.index')->with('user', $user)->with('message', '')
                                                        ->with('bmr', $bmr)
                                                        ->with('suggested_bmr', $suggested_bmr);
    }

    public function form(Profile $profile = null)
    {
        $profile = $profile ?: new Profile;  
        return view("profiles.form")->with("profile", $profile);
    }

    public function post(ProfileRequest $request)
    {
        $profile = Profile::firstOrNew(['id' => $request->get('id')]);
        //$profile->id = $request->get('id');
        $profile->user_id = $request->get('user_id');
        $profile->height = $request->get('height');
        $profile->weight = $request->get('weight');
        $profile->age = $request->get('age');
        $gender = $request->get('gender');
        $profile->gender = strtolower($gender);
        $profile->contact = $request->get('contact');
        $profile->plan = $request->get('plan');
        if ($request->file('avatar')) {
            $profile->avatar = $this->upload($request->file('avatar'), 'profiles')->getFileName();
        } else {
            $profile->avatar = $profile->avatar;
        }

        $profile->user_id = auth()->user()->id;

        $profile->save();

        //$message = trans('redprint::core.model_added', ['name' => 'profile']);
        return redirect()->route('profiles.home');
    }
}
