<?php

namespace App\Services\Interfaces;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

interface IOrderService
{
    /**
     * Fetch orders by Condition Repository
     *
     * @param array $condition
     *
     * @return mixed
     */
    public function getOrdersByCondition(array $condition): mixed;

    /**
     * @param string|null $date
     * @param string $todayDate
     * @param string|null $status
     *
     * @return mixed
     */
    public function getOrdersByFilter(?string $date, string $todayDate, ?string $status):mixed;

    public function updateStatusMessage(Request $request, int $id):Order;
}
