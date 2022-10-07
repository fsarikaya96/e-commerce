<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        /*$today  = Carbon::now();
        $orders = Order::whereDate('created_at', $today)->get();*/
        $todayDate  = Carbon::now();
        $orders = Order::when($request->date != null, function ($query) use ($request){

                           return $query->whereDate('created_at',$request->date);
                         },function ($query) use ($todayDate){

                            return $query->whereDate('created_at',$todayDate);
                        })
                       ->when($request->status != null, function ($query) use ($request){

                          return $query->where('status_message', $request->status);
                       })
                       ->paginate(10);

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
