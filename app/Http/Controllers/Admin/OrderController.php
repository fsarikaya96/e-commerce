<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $today  = Carbon::now();
        $orders = Order::whereDate('created_at', $today)->get();

        return view('admin.order.index', compact('orders'));
    }

    public function show($orderID)
    {
        $order = Order::where('id', $orderID)->first();
        if (count($order->orderItems) == null) {
            return redirect()->back()->with('error', 'Siparişiniz Bulunamadı !');
        }
        return view('admin.order.show', compact('order'));
    }
}
