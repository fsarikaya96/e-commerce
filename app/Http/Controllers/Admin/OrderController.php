<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\IOrderService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private IOrderService $orderService;
    public function __construct(IOrderService $IOrderService)
    {
        $this->orderService = $IOrderService;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $orders = $this->orderService->getOrdersByFilter($request->date, Carbon::now(), $request->status);

        return view('admin.order.index', compact('orders'));
    }

    public function show($orderID)
    {
        $order = $this->orderService->getOrdersByCondition(['id' => $orderID])->first();
        if (count($order->orderItems) == null) {
            return redirect()->back()->with('error', 'Siparişiniz Bulunamadı !');
        }

        return view('admin.order.show', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = $this->orderService->updateStatusMessage($request,$id);

        if (count($order->orderItems) == null) {
            return redirect('admin/orders/'.$order->id)->with('error', 'Güncelleme Başarısız!');
        }
        return redirect('admin/orders/'.$order->id)->with('success', 'Güncelleme Başarılı!');

    }
}
