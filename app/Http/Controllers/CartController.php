<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
        $cart = DB::table('cart')->where('product_id', $request->product_id)->where('user_id', Auth::user()->id);
        if ($cart->get()->count() > 0) {
            $order = $cart->pluck('order')[0];
            $order += 1;

            DB::table('cart')->where('product_id', $request->product_id)->where('user_id', Auth::user()->id)->update(['order' => $order]);

            session()->flash('success', 'Product has been added.');

            return redirect('/cart');
        }
        $cart = new Cart();

        $cart->product_id = $request->product_id;
        $cart->user_id = Auth::user()->id;
        $cart->order = 1;

        $cart->save();

        session()->flash('success', 'The product was add to cart.');

        return redirect('/detail/' . $request->slug);
    }

    public function plus($cart_id)
    {
        $order = DB::table('cart')->where('id', $cart_id)->pluck('order')[0];
        $order += 1;

        DB::table('cart')->where('id', $cart_id)->update(['order' => $order]);

        session()->flash('success', 'Product has been added.');

        return redirect('/cart');
    }

    public function minus($cart_id)
    {
        $order = DB::table('cart')->where('id', $cart_id)->pluck('order')[0];
        if ($order > 1) {
            $order -= 1;

            DB::table('cart')->where('id', $cart_id)->update(['order' => $order]);

            session()->flash('success', 'Product has been reduced.');

            return redirect('/cart');
        }
        session()->flash('error', 'Product cannot be reduced.');

        return redirect('/cart');
    }

    public function delete($cart_id)
    {
        DB::table('cart')->where('id', $cart_id)->delete();

        session()->flash('success', 'The product was deleted.');

        return redirect('/cart');
    }

    public function checkout()
    {
        $total = 0;
        $userId = Auth::user()->id;
        $user = DB::table('users')->where('id', $userId)->pluck('address')[0];
        $payments = DB::table('payments')->where('active', 1)->get();
        $products = DB::table('cart')->join('products', 'cart.product_id', '=', 'products.id')->where('cart.user_id', $userId)->select('products.*', 'cart.id as cart_id', 'cart.order')->get();

        foreach ($products as $product) {
            $total += $product->price * $product->order;
        }

        return view('products.checkout', compact('total', 'products', 'user'));
    }

    public function order(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'payment_method' => 'required'
        ]);
    }
}
