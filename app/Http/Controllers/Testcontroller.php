<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class Testcontroller extends Controller
{
    public function index()
    {
        $product = Product::where('long_name', 'ORIGINAL BARBECUE SAUCE')->first();
        echo $product->manufacturer;
        exit;
    }
}
