<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Auth};

class OrderController extends Controller
{
    public function checkout(Order $order)
    {
        $total = 0;
        $userId = Auth::user()->id;
        $payments = DB::table('payments')->where('active', 1)->get();
        $user = DB::table('users')->where('id', $userId)->pluck('address')[0];

        $products = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->where('cart.user_id', $userId)
            ->select('products.*', 'cart.id as cart_id', 'cart.order')->get();

        foreach ($products as $product) {
            $total += $product->price * $product->order;
        }

        return view('order.checkout', compact('total', 'products', 'user', 'payments', 'order'));
    }

    public function order(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'payment_method' => 'required'
        ]);

        DB::table('users')->where('id', Auth::user()->id)->update(['address' => $request->address]);

        $carts = DB::table('cart')->where('user_id', Auth::user()->id)->get();

        foreach ($carts as $cart) {
            $order = new Order();

            $order->product_id = $cart->product_id;
            $order->user_id = $cart->user_id;
            $order->order = $cart->order;
            $order->description = $request->description;
            $order->payment_method = $request->payment_method;
            $order->payment_status = 0;
            $order->delivery_status = 0;
            $order->delivery_description = '';
            $order->created_at = now();
            $order->updated_at = now();
            $order->save();

            DB::table('cart')->where('user_id', Auth::user()->id)->delete();
        }

        session()->flash('success', 'The product was ordered.');

        return redirect('/');
    }

    public function my_order()
    {
        $total = 0;
        $perPage = 10;
        $userId = Auth::user()->id;
        $currentPage = $_GET['page'] ?? 1;
        $i = 1 + $perPage * ($currentPage - 1);

        $orders = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->join('payments', 'orders.payment_method', '=', 'payments.id')
            ->select('orders.id as order_id', 'orders.*', 'products.*', 'payments.*', 'products.name as product_name')
            ->where('orders.user_id', $userId)->simplePaginate($perPage);

        return view('order.my-order', compact('orders', 'total', 'i'));
    }

    public function detail($order)
    {
        $results = Order::where('orders.id', $order)->join('delivery', 'orders.delivery_status', '=', 'delivery.id')->get();
        return view('order.detail', compact('results'));
    }
}
