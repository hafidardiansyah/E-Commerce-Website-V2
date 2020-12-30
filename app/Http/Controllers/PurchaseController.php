<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function purchase()
    {
        $total = 0;
        $perPage = 10;
        $currentPage = $_GET['page'] ?? 1;
        $i = 1 + $perPage * ($currentPage - 1);

        $orders = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->where(['payment_status' => !0])
            ->select('products.*', 'users.*', 'orders.*', 'orders.id as order_id')
            ->simplePaginate($perPage);

        $delivery = DB::table('orders')
            ->join('delivery', 'orders.delivery_status', '=', 'delivery.id')
            ->select('name', 'delivery_description')
            ->get();

        return view('purchase.purchase', compact('orders', 'total', 'i', 'delivery'));
    }

    public function edit($purchase)
    {
        return view('purchase.edit', [
            'delivery' => Delivery::where(['active' => 1])->get(),
            'purchase' => Order::join('delivery', 'orders.payment_status', '=', 'delivery.id')->where('orders.id', $purchase)->select('delivery.*', 'orders.*', 'orders.id as order_id')->get(),
        ]);
    }

    public function update(Request $request, $purchase)
    {
        $request->validate([
            'delivery_status' => 'required',
            'delivery_description' => 'required',
        ]);

        Order::where('id', $purchase)->update([
            'delivery_status' =>  $request->delivery_status,
            'delivery_description' => $request->delivery_description
        ]);

        session()->flash('success', 'The puchase was updated.');

        return redirect('/purchase');
    }
}
