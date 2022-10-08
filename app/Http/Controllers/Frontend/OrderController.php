<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\IOrderService;

class OrderController extends Controller
{
    private IOrderService $orderService;

    public function __construct(IOrderService $IOrderService)
    {
        $this->orderService = $IOrderService;
    }

    public function index()
    {
        $orders = $this->orderService->getOrdersByCondition(['user_id' => auth()->user()->id])->orderBy('created_at', 'DESC')->paginate(10);

        return view('frontend.order.index', compact('orders'));
    }

    public function show($orderID)
    {
        $order = $this->orderService->getOrdersByCondition(['user_id' => auth()->user()->id, 'id' => $orderID])->first();
        if (count($order->orderItems) == null) {
            return redirect()->back()->with('error', 'Siparişiniz Bulunamadı !');
        }

        return view('frontend.order.show', compact('order'));
    }
}
