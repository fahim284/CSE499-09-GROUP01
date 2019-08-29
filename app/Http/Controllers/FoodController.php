<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Product;
use Carbon\Carbon;
use App\FoodHistory;
use App\ServingSize;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function getIndex()
    {

    	return view('food.index');
    }

    public function postFood(Request $request)
    {

    }

    public function getFoodCatalogue(Request $request)
    {
    	$foodItems = Product::
                        where('long_name', 'LIKE', '%'.strtoupper($request->get('term')).'%')
                        ->select('products.long_name', 'products.id')
                        ->limit(200)->get();
    	return response()->json($foodItems);
    }

    public function getNutritionDetails(Product $product)
    {

        $client = new \GuzzleHttp\Client();
        $response = $client->request(
            'GET',
            'https://api.nal.usda.gov/ndb/reports/?ndbno='.$product->id.'&type=f&format=json&api_key='.env('USFDA_KEY')
        );

        echo $response->getBody();
    }

    public function postConsumeFood(Request $request) {
        $history = new FoodHistory;
        $history->user_id = auth()->user()->id;
        $history->product_id = $request->get('product_id');
        $history->units = $request->get('intake');
        $history->net_calorie = (int) $request->get('energy') * (int) $request->get('intake');
        $history->energy = $request->get('energy');
        $history->save();

        return response()->json(['saved' => true]);
    }

    public function reportForm()
    {
        return view('reports.form');
    }

    public function reportPost(Request $request)
    {
        $request->validate(["date_from"=> "required"]);

        $date_from = Carbon::parse($request->get('date_from'));
        $date_to = Carbon::parse($request->get('date_to'))->endOfDay();

        $difference = $date_from->diffInDays($date_to);
        if ($difference == 0)
        {
            $difference = 1;
        }

        $histories = FoodHistory::with('product');

        $net_calorie = $histories->where('user_id', auth()->user()->id)->whereBetween('created_at', [$date_from, $date_to])->sum('net_calorie');

        $histories = $histories->whereBetween('created_at', [$date_from, $date_to])->paginate(5);

        $person = Profile::where('user_id', auth()->user()->id)->first();
        $gender = $person->gender;
        $suggested_bmr = 0;

        if($gender == 'male')
        {
            $bmr = 66 + (13.7 * $person->weight) + (5 * $person->height) - (6.8 * $person->age);
            $bmr = $bmr * 1.2;
            
            if($person->plan == 1)
            {
                $suggested_bmr = $bmr - 500;
                $suggested_bmr = $suggested_bmr * $difference;
            }
            else
            {
                $suggested_bmr = $bmr + 200;
                $suggested_bmr = $suggested_bmr * $difference;    
            }
            
        }

        else
        {
            $bmr = 655 + (9.6 * $person->weight) + (1.8 * $person->height) - (4.7 * $person->age);
            $bmr = $bmr * 1.2;

            if($person->plan == 1)
            {
                $suggested_bmr = $bmr - 500;
                $suggested_bmr = $suggested_bmr * $difference;
            }

            else
            {
                $suggested_bmr = $bmr + 200;
                $suggested_bmr = $suggested_bmr * $difference;
            } 
        }
        

        if($histories->count() == 0)
        {
            return view('reports.index')
                ->with('histories', $histories)
                ->with('message', 'There Is No Record Between Given Dates')
                ->with('net_calorie', '')
                ->with('suggested_bmr', $suggested_bmr)
                ->with('person', $person)
                ->with('profit', '')
                ->with('loss', '');
        }

        if ($suggested_bmr > $net_calorie)
        {
            $profit = $suggested_bmr - $net_calorie;

            return view('reports.index')
            ->with('histories', $histories)
            ->with('message', '')
            ->with('net_calorie', $net_calorie)
            ->with('suggested_bmr', $suggested_bmr)
            ->with('profit', $profit)
            ->with('loss', '')
            ->with('person', $person);
        }

        else
        {
            $loss = $net_calorie - $suggested_bmr;

            return view('reports.index')
            ->with('histories', $histories)
            ->with('message', '')
            ->with('net_calorie', $net_calorie)
            ->with('suggested_bmr', $suggested_bmr)
            ->with('profit', '')
            ->with('loss', $loss)
            ->with('person', $person);
        }

        
        /*return view('reports.index')
            ->with('histories', $histories)
            ->with('message', '')
            ->with('net_calorie', $net_calorie);*/

    }
}
