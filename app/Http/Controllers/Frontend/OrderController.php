<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->paginate(10);

        return view('frontend.order.index', compact('orders'));
    }

    public function show($orderID)
    {
        $order = Order::where('user_id', auth()->user()->id)->where('id', $orderID)->first();
        if (count($order->orderItems) == null) {
            return redirect()->back()->with('error', 'Siparişiniz Bulunamadı !');
        }

        return view('frontend.order.show', compact('order'));
    }
}
