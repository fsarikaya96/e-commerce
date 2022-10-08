<?php

namespace App\Repository\Implementations;

use App\Models\Order;
use App\Models\OrderItem;
use App\Repository\Interfaces\IOrderRepository;
use Carbon\Carbon;

class OrderRepository implements IOrderRepository
{
    public function getOrdersByCondition(array $condition): mixed
    {
        return Order::where($condition);
    }

    /**
     * @param string|null $date
     * @param string $todayDate
     * @param string|null $status
     *
     * @return mixed
     */
    public function getOrdersByFilter(?string $date, string $todayDate, ?string $status): mixed
    {
        $todayDate = Carbon::now();
        return Order::when($date != null, function ($query) use ($date){

             return $query->whereDate('created_at',$date);
            },function ($query) use ($todayDate){

                return $query->whereDate('created_at',$todayDate);
            })
            ->when($status != null, function ($query) use ($status){

                return $query->where('status_message', $status);
            })
            ->paginate(10);
    }
    public function createOrderItems(OrderItem $orderItem):OrderItem
    {
        $orderItem->save();

        return $orderItem;

    }

    public function createOrder(Order $order):Order
    {
        $order->save();

        return $order;

    }

}
