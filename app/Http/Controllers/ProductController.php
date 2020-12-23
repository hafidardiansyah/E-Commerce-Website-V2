<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
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

        $image = request()->file('image')->store('images');

        $attr['image'] = $image;

        // * Create new post
        Product::create($attr);

        session()->flash('success', 'The post was created.');

        // session()->flash('error', 'The post was created.');

        return redirect('/');
    }
}
