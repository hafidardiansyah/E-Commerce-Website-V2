<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function category(Category $category)
    {
        return view('products.products', [
            'categories' => Category::latest()->simplePaginate(32),
            'products' => $category->products()->latest()->simplePaginate(10)
        ]);
    }
}
