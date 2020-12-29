<?php

namespace App\Http\Controllers;

use App\Models\{Product, Category};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\{Storage, Auth};

class ProductController extends Controller
{
    public function index()
    {
        return view('products.home', [
            'carouselProducts' => Product::limit(5)->get(),
            'products' => Product::latest()->simplePaginate(32),
            'categories' => Category::latest()->simplePaginate(10)
        ]);
    }

    public function products()
    {
        return view('products.products', [
            'products' => Product::latest()->simplePaginate(32),
            'categories' => Category::latest()->simplePaginate(10)
        ]);
    }

    public function detail(Product $product)
    {
        return view('products.detail', [
            'product' => $product,
            'role' => Auth::check() ? Auth::user()->role : 1
        ]);
    }

    public function search()
    {
        $keyword = request('keyword');
        $products = Product::where('name', 'like', "%$keyword%")->latest()->simplePaginate(32);

        return view('products.products', compact('products'));
    }

    public function create()
    {
        return view('products.create', [
            'product' => new Product(),
            'categories' => Category::get()
        ]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png|max:1024',
            'name' => 'required|min:3|unique:products',
            'price' => 'required',
            'description' => 'required',
            'category' => 'required'
        ]);

        $attr = $request->all();
        $image = request()->file('image') ? request()->file('image')->store('images') : null;
        $slug = Str::slug($request->name);

        $attr['category_id'] = request('category');
        $attr['image'] = $image;
        $attr['slug'] = $slug;

        // * Create new post
        Product::create($attr);

        session()->flash('success', 'The post was created.');

        return redirect('/');
    }

    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product,
            'categories' => Category::get()
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,jpg,png|max:1024',
            'name' => 'required|min:3|unique:products,name,' . $product->id,
            'price' => 'required',
            'description' => 'required',
        ]);

        if (request()->file('image')) {
            Storage::delete($product->image);
            $image = request()->file('image')->store('images');
        } else {
            $image = $product->image;
        }

        $attr = $request->all();

        $attr['category_id'] =  request('category');
        $attr['image'] = $image;
        $attr['slug'] = Str::slug($request->name);

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
