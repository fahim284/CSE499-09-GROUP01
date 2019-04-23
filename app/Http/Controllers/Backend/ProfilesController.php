<?php

namespace App\Http\Controllers\Backend;

use App\Profile;
use Illuminate\Http\Request;
use Shahnewaz\Redprint\Traits\CanUpload;
use App\Http\Requests\Backend\ProfileRequest;
use App\Http\Controllers\Controller;

class ProfilesController extends Controller
{
    use CanUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $profiles = Profile::withTrashed();
        
        if ($request->has('height')) {
            $profiles = $profiles->where('height', 'LIKE', '%'.$request->get('height').'%');
        }
        if ($request->has('weight')) {
            $profiles = $profiles->where('weight', 'LIKE', '%'.$request->get('weight').'%');
        }
        if ($request->has('gender')) {
            $profiles = $profiles->where('gender', 'LIKE', '%'.$request->get('gender').'%');
        }
        if ($request->has('contact')) {
            $profiles = $profiles->where('contact', 'LIKE', '%'.$request->get('contact').'%');
        }
        if ($request->has('plan')) {
            $profiles = $profiles->where('plan', 'LIKE', '%'.$request->get('plan').'%');
        }
        $profiles = $profiles->paginate(20);
        return view('backend.profiles.index')->with('profilesData', $profiles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form(Profile $profile = null)
    {
        $profile = $profile ?: new Profile;
        $users = \App\User::pluck('first_name', 'id')->toArray();
        return view('backend.profiles.form')->with('profile', $profile)->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(ProfileRequest $request, Profile $profile)
    {
        $profile = Profile::firstOrNew(['id' => $request->get('id')]);
        $profile->id = $request->get('id');
        $profile->height = $request->get('height');
        $profile->weight = $request->get('weight');
        $profile->gender = $request->get('gender');
        $profile->contact = $request->get('contact');
        $profile->plan = $request->get('plan');
        if ($request->file('avatar')) {
            $profile->avatar = $this->upload($request->file('avatar'), 'profiles')->getFileName();
        } else {
            $profile->avatar = $profile->avatar;
        }

        $profile->user_id = $request->get('user_id');
        $profile->save();

        $message = trans('redprint::core.model_added', ['name' => 'profile']);
        return redirect()->route('profile.index')->withMessage($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Profile $profile)
    {
        $profile->delete();
        $message = trans('redprint::core.model_deleted', ['name' => 'profile']);
        return redirect()->back()->withMessage($message);
    }

    /**
     * Restore the specified deleted resource to storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($profileId)
    {
        $profile = Profile::withTrashed()->find($profileId);
        $profile->restore();
        $message = trans('redprint::core.model_restored', ['name' => 'profile']);
        return redirect()->back()->withMessage($message);
    }

    public function forceDelete($profileId)
    {
        $profile = Profile::withTrashed()->find($profileId);
        $profile->forceDelete();
        $message = trans('redprint::core.model_permanently_deleted', ['name' => 'profile']);
        return redirect()->back()->withMessage($message);
    }
}
