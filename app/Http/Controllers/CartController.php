<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        redirect('/');
    }

    public function cart()
    {
        if (Auth::check() && Auth::user()->role != 1) {
            session()->flash('error', 'No access for admin.');
            return redirect('/');
        }

        $perPage = 10;
        $currentPage = $_GET['page'] ?? 1;
        $i = 1 + $perPage * ($currentPage - 1);
        $products = Cart::join('products', 'cart.product_id', '=', 'products.id')->where('cart.user_id', Auth::user()->id)->select('products.*', 'cart.id as cart_id')->simplePaginate($perPage);

        return view('products.cart', compact('products', 'i'));
    }

    public function add(Request $request)
    {
        if (Auth::check() && Auth::user()->role != 1) {
            session()->flash('error', 'No access for admin.');
            return redirect('/');
        }

        $cart = new Cart();
        $cart->product_id = $request->product_id;
        $cart->user_id = $request->user_id;
        $cart->save();

        session()->flash('success', 'The product was add to cart.');

        return redirect('/detail/' . $request->slug);
    }

    public function delete(Cart $cart)
    {
        $cart->delete();

        session()->flash('success', 'The product was deleted.');

        return redirect('/cart');
    }
}
