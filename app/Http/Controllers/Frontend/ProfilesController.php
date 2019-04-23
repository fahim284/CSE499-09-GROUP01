<?php

namespace App\Http\Controllers\Frontend;

use App\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $profiles = Profile::query();
        $profiles = $profiles->paginate(20);
        return view('frontend.profiles.index')->with('profilesData', $profiles);
    }
}
