<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function index()
    {
        return view('products.home', [
            'carouselProducts' => Product::limit(5)->get(),
            'products' => Product::latest()->simplePaginate(8)
        ]);
    }

    public function list_product()
    {
        return view('products.list-product', [
            'products' => Product::latest()->simplePaginate(32)
        ]);
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function search()
    {
        $keyword = request('keyword');
        $products = Product::where('name', 'like', "%$keyword%")->latest()->simplePaginate(32);
        return view('products.list-product', compact('products'));
    }

    public function create()
    {
        return view('products.create', [
            'product' => new Product(),
        ]);
    }

    public function store(ProductRequest $request)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,jpg,png|max:1024'
        ]);

        $attr = $request->all();

        $slug = Str::slug($request->name);
        $attr['slug'] = $slug;

        $image = request()->file('image') ? request()->file('image')->store('images') : null;

        $attr['image'] = $image;

        // * Create new post
        Product::create($attr);

        session()->flash('success', 'The post was created.');

        return redirect('/');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,jpg,png|max:1024'
        ]);

        if (request()->file('image')) {
            Storage::delete($product->image);
            $image = request()->file('image')->store('images');
        } else {
            $image = $product->image;
        }

        $attr = $request->all();
        $attr['image'] = $image;

        $product->update($attr);

        session()->flash('success', 'The product was updated.');

        return redirect('/detail/' . $product->slug);
    }

    public function delete(Product $product)
    {
        Storage::delete($product->image);
        $product->delete();

        session()->flash('success', 'The product was deleted.');

        return redirect('/');
    }
}
