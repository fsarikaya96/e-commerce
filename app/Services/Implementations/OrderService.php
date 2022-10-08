<?php

namespace App\Services\Implementations;

use App\Models\Order;
use App\Models\OrderItem;
use App\Repository\Interfaces\ICartRepository;
use App\Repository\Interfaces\IOrderRepository;
use App\Services\Interfaces\IOrderService;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderService implements IOrderService
{
    private IOrderRepository $orderRepository;
    private FlasherInterface $flasher;
    private ICartRepository $cartRepository;

    /**
     * @param IOrderRepository $IOrderRepository
     * @param FlasherInterface $IFlasher
     * @param ICartRepository $ICartRepository
     */
    public function __construct(
        IOrderRepository $IOrderRepository,
        FlasherInterface $IFlasher,
        ICartRepository $ICartRepository
    ) {
        $this->orderRepository = $IOrderRepository;
        $this->flasher         = $IFlasher;
        $this->cartRepository  = $ICartRepository;
    }

    /**
     * @param array $condition
     *
     * @return mixed
     */
    public function getOrdersByCondition(array $condition): mixed
    {
        return $this->orderRepository->getOrdersByCondition($condition);
    }

    public function getOrdersByFilter(?string $date, string $todayDate, ?string $status): mixed
    {
        return $this->orderRepository->getOrdersByFilter($date, $todayDate, $status);
    }

    public function createOrderWithOrderItems(Order $order, $orderItems)
    {
        $orderModel                 = new Order();
        $orderModel->user_id        = auth()->user()->id;
        $orderModel->tracking_no    = 'jfeel-' . Str::random(10);
        $orderModel->full_name      = $order->full_name;
        $orderModel->phone          = $order->phone;
        $orderModel->email          = $order->email;
        $orderModel->province       = $order->province;
        $orderModel->county         = $order->county;
        $orderModel->address        = $order->address;
        $orderModel->status_message = 'in progress';
        $order                      = $this->orderRepository->createOrder($orderModel);

        foreach ($orderItems as $orderItem) {
            $orderItemModel                   = new OrderItem();
            $orderItemModel->order_id         = $order->id;
            $orderItemModel->product_id       = $orderItem['product_id'];
            $orderItemModel->product_color_id = $orderItem['product_color_id'];
            $orderItemModel->quantity         = $orderItem['quantity'];
            $orderItemModel->price            = $orderItem->products->selling_price;
            $this->orderRepository->createOrderItems($orderItemModel);

            if ($orderItem->product_color_id != null) {
                $orderItem->productColors()->where('id', $orderItem->product_color_id)->decrement(
                    'quantity',
                    $orderItem->quantity
                );
            } else {
                $orderItem->products()->where('id', $orderItem->product_id)->decrement(
                    'quantity',
                    $orderItem->quantity
                );
            }
        }

        $this->cartRepository->getCartByCondition(['user_id' => auth()->user()->id])->delete();
        $this->flasher->addSuccess('Ödeme Başarılı!');

        return redirect()->to('thank-you');
    }
    public function updateStatusMessage(Request $request,int $id): Order
    {
        $order = $this->orderRepository->getOrdersByCondition(['id' => $id])->first();
        $order->status_message = $request->status_message;

        return $this->orderRepository->updateStatusMessage($order);

    }

}
