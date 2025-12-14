<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Season;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //
    public function index()
    {
        $seasons = Season::all();
        $products = Product::all();
        return view('products.index', compact('products', 'seasons'));
    }

    public function register()
    {
        $allseasons = Season::all();
        $products = Product::all();
        return view('products.register', compact('products', 'allseasons'));
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

    public function update(ProductRequest $request, Product $product)
    {
        $product = Product::find($request->id);
        
        if ($request->hasFile('image')) {
        // 既存画像の削除 (storage/app/public/images/ の中のパス)
            $dir = 'img';
            Storage::disk('public')->delete('public/img/' . $product->image);
        // 新しい画像の保存
            $file= $request->file('image');
            $file_name = $request->file('image')->getClientOriginalName();
            $path = $file->storeAs('public/img', $file_name); // storage/app/public/img/ に保存
            $product->image = basename($path);
            $product->save();
        }
        //季節の更新
        $seasonIds = $request->input('allseason_ids', []);
        $product->seasons()->sync($seasonIds);
        $product = $request->only([
                'name',
                'price',
                'description',
        ]);

        Product::find($request->id)->update($product);

        return redirect('/')->with('message', '更新しました');;
    }

    public function store(ProductRequest $request, Product $product)
    {
        if ($request->has('back')) {
            return redirect('/')->withInput();
        }

        if ($request->hasFile('image')) {
        // 既存画像の削除 (storage/app/public/images/ の中のパス)
            $dir = 'img';
        // 新しい画像の保存
            $file= $request->file('image');
            $file_name = $request->file('image')->getClientOriginalName();
            $path = $file->storeAs('public/img', $file_name); // storage/app/public/img/ に保存
        }
        $seasonIds = $request->input('allseason_ids', []);

        Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'image' => basename($path),
                'description' => $request->description,
                'season_ids' => syc($seasonIds),
        ]);
        //季節の更新
        
        $products = Product::all();
        $allseasons = Season::all();
        
        return view('products', compact('product', 'allseasons'));
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
