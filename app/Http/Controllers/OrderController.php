<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Auth};

class OrderController extends Controller
{
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
            $order->payment_status = 'unpaid';
            $order->delivery_status = Delivery::where(['active' => 1])->pluck('id')[0];
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
        $orders = DB::table('orders')->join('products', 'orders.product_id', '=', 'products.id')->where('orders.user_id', $userId)->simplePaginate($perPage);

        return view('products.my-order', compact('orders', 'total', 'i'));
    }
}
