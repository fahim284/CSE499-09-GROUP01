<?php

namespace App\Http\Controllers;

use App\Product;
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

    public function getServingSize(Product $product)
    {
        return response()->json($product->servingSize);
    }
}
