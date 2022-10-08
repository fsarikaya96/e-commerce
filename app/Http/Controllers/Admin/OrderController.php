<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\IOrderService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function viewInvoice($id)
    {
        $order = $this->orderService->getOrdersByCondition(['id' => $id])->first();
        return view('admin.invoice.invoice-generate',compact('order'));
    }
    public function generateInvoice($id)
    {
        $order = $this->orderService->getOrdersByCondition(['id' => $id])->first();
        $data = ['order' => $order];
        $pdf = Pdf::loadView('admin.invoice.invoice-generate', $data);
        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('fatura-'.$order->id.'-'.$todayDate.'.pdf');
    }
}
