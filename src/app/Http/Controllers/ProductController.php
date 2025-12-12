<?php

namespace App\Http\Controllers;
use App\Models\Season;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        $seasons = Season::all();
        $products = Product::all();
        return view('products.index', compact('products', 'seasons'));
    }

}
