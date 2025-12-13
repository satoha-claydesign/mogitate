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

    public function search(Request $request)
    {
        $query = Product::query();

        $query = $this->getSearchQuery($request, $query);

        $products = $query->paginate(6);

        $seasons = Season::all();
        return view('products.index', compact('products', 'seasons'));
    }

    public function sort(Request $request)
    {
        $sortDirection = $request->input('order', 'desc');
        $products = Product::orderBy('price', $sortDirection)->get();
        return view('products.sort', compact('products', 'sortDirection'));
    }

    public function show($id)
    {
        $product = Product::find($id); // または Post::find($id);
        $seasons = Product::find($id)->seasons();
        $allseasons = Season::all();
        return view('products.show', compact('product', 'seasons', 'allseasons')); // posts.showビューにデータを渡す
    }

    private function getSearchQuery($request, $query)
    {
        if(!empty($request->keyword)) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%');
            });
        }
        return $query;
    }
}
