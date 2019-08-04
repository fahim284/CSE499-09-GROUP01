<?php

namespace App\Http\Controllers\Backend;

use App\FoodHistory;
use Illuminate\Http\Request;
use Shahnewaz\Redprint\Traits\CanUpload;
use App\Http\Requests\Backend\FoodHistoryRequest;
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
        $foodHistories = FoodHistory::withTrashed();
        
        $foodHistories = $foodHistories->paginate(20);
        return view('backend.foodHistories.index')->with('foodHistoriesData', $foodHistories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form(FoodHistory $foodHistory = null)
    {
        $foodHistory = $foodHistory ?: new FoodHistory;
		$users = \App\User::pluck('first_name', 'id')->toArray();
		$products = \App\Product::pluck('long_name', 'id')->toArray();
		return view('backend.foodHistories.form')->with('foodHistory', $foodHistory)->with('users', $users)->with('products', $products);
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

$foodHistory->user_id = $request->get('user_id');
$foodHistory->product_id = $request->get('product_id');
        $foodHistory->save();

        $message = trans('redprint::core.model_added', ['name' => 'foodHistory']);
        return redirect()->route('foodHistory.index')->withMessage($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(FoodHistory $foodHistory)
    {
        $foodHistory->delete();
        $message = trans('redprint::core.model_deleted', ['name' => 'foodHistory']);
        return redirect()->back()->withMessage($message);
    }

    /**
     * Restore the specified deleted resource to storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($foodHistoryId)
    {
        $foodHistory = FoodHistory::withTrashed()->find($foodHistoryId);
        $foodHistory->restore();
        $message = trans('redprint::core.model_restored', ['name' => 'foodHistory']);
        return redirect()->back()->withMessage($message);
    }

    public function forceDelete($foodHistoryId)
    {
        $foodHistory = FoodHistory::withTrashed()->find($foodHistoryId);
        $foodHistory->forceDelete();
        $message = trans('redprint::core.model_permanently_deleted', ['name' => 'foodHistory']);
        return redirect()->back()->withMessage($message);
    }
}
