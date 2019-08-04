<?php

namespace App\Http\Controllers\Backend\API;

use App\FoodHistory;
use Illuminate\Http\Request;
use Shahnewaz\Redprint\Traits\CanUpload;
use App\Http\Requests\Backend\FoodHistoryRequest;
use App\Http\Resources\FoodHistoryCollection;
use App\Http\Resources\FoodHistory as FoodHistoryResource;
use App\Http\Controllers\Controller;

class FoodHistoriesController extends Controller
{
    use CanUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $foodHistories = FoodHistory::query();
        
        $foodHistories = $foodHistories->paginate(20);
        return (new FoodHistoryCollection($foodHistories));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(FoodHistoryRequest $request, FoodHistory $foodHistory)
    {
        $foodHistory = FoodHistory::firstOrNew(['id' => $request->get('id')]);
        $foodHistory->id = $request->get('id');
		$foodHistory->energy = $request->get('energy');
		$foodHistory->units = $request->get('units');

        $foodHistory->save();

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
        $foodHistory = FoodHistory::find($request->get('id'));
        $foodHistory->delete();
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
        $foodHistory = FoodHistory::withTrashed()->find($request->get('id'));
        $foodHistory->restore();
        return response()->json(['no_content' => true], 200);
    }
}
