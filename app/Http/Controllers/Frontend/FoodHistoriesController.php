<?php

namespace App\Http\Controllers\Frontend;

use App\FoodHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FoodHistoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $foodHistories = FoodHistory::query();
        $foodHistories = $foodHistories->paginate(20);
        return view('frontend.foodHistories.index')->with('foodHistoriesData', $foodHistories);
    }
}
