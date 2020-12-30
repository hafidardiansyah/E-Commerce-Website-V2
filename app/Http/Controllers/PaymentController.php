<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function payment()
    {
        $order = new Order;
        return view('payment.payment', compact('order'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'code' => 'required|min:5'
        ]);

        $r = substr($request->code, 4);
        $order = Order::all();
        $query = $order->find($r);

        if (isset($query)) {
            Order::where(['id' => $r])->update(['payment_status' => 1, 'delivery_status' => 1, 'delivery_description' => 'Admin']);
            session()->flash('success', 'The product was updated.');

            return redirect('/purchase');
        }
        session()->flash('error', 'Error.');

        return redirect('/');;
    }
}
