<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function __construct()
    {
        redirect('/');
    }

    public function cart()
    {
        $total = 0;
        $perPage = 10;
        $currentPage = $_GET['page'] ?? 1;
        $i = 1 + $perPage * ($currentPage - 1);
        $products = Cart::join('products', 'cart.product_id', '=', 'products.id')->where('cart.user_id', Auth::user()->id)->select('products.*', 'cart.id as cart_id', 'cart.order')->simplePaginate($perPage);

        return view('products.cart', compact('products', 'total', 'i'));
    }

    public function add(Request $request)
    {
        $cart = new Cart();

        $cart->product_id = $request->product_id;
        $cart->user_id = $request->user_id;
        $cart->order = 1;
        $cart->save();

        session()->flash('success', 'The product was add to cart.');

        return redirect('/detail/' . $request->slug);
    }

    public function plus($cart)
    {
        $order = DB::table('cart')->where('id', $cart)->sum('order');
        $order += 1;

        DB::table('cart')->where('id', $cart)->update(['order' => $order]);

        session()->flash('success', 'The product was add.');

        return redirect('/cart');
    }

    public function delete($cart)
    {
        Cart::destroy($cart);

        session()->flash('success', 'The product was deleted.');

        return redirect('/cart');
    }

    public function order()
    {
        $userId = Auth::user()->id;
        $total = DB::table('cart')->join('products', 'cart.product_id', '=', 'products.id')->where('cart.user_id', $userId)->sum('products.price');
        $products = DB::table('cart')->join('products', 'cart.product_id', '=', 'products.id')->where('cart.user_id', $userId)->select('products.*', 'cart.id as cart_id')->get();

        return view('products.order', compact('total', 'products'));
    }
}
