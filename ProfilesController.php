<?php

namespace App\Http\Controllers\Backend\API;

use App\Profile;
use Illuminate\Http\Request;
use Shahnewaz\Redprint\Traits\CanUpload;
use App\Http\Requests\Backend\ProfileRequest;
use App\Http\Resources\ProfileCollection;
use App\Http\Resources\Profile as ProfileResource;
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
        $profiles = Profile::query();
        
        if ($request->has('weight')) {
            $profiles = $profiles->where('weight', 'LIKE', '%'.$request->get('weight').'%');
        }
        if ($request->has('gender')) {
            $profiles = $profiles->where('gender', 'LIKE', '%'.$request->get('gender').'%');
        }
        $profiles = $profiles->paginate(20);
        return (new ProfileCollection($profiles));
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
        if ($request->file('avatar')) {
            $profile->avatar = $this->upload($request->file('avatar'), 'profiles')->getFileName();
        } else {
            $profile->avatar = $profile->avatar;
        }
        $profile->plan = $request->get('plan');

        $profile->save();

        $responseCode = $request->get('id') ? 200 : 201;
        return response()->json(['saved' => true], $responseCode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $profile = Profile::find($request->get('id'));
        $profile->delete();
        return response()->json(['no_content' => true], 200);
    }

    /**
     * Restore the specified resource to storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request)
    {
        $profile = Profile::withTrashed()->find($request->get('id'));
        $profile->restore();
        return response()->json(['no_content' => true], 200);
    }
}
