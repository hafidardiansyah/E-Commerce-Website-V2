<?php

namespace App\Http\Controllers;

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
            ->simplePaginate($perPage);

        $delivery = DB::table('orders')
            ->join('delivery', 'orders.delivery_status', '=', 'delivery.id')
            ->select('name', 'delivery_description')
            ->get();

        return view('purchase.purchase', compact('orders', 'total', 'i', 'delivery'));
    }
}
