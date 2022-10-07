<?php

namespace App\Services\Implementations;

use App\Repository\Interfaces\IOrderRepository;
use App\Services\Interfaces\IOrderService;

class OrderService implements IOrderService
{
    private IOrderRepository $orderRepository;

    /**
     * @param IOrderRepository $IOrderRepository
     */
    public function __construct(IOrderRepository $IOrderRepository)
    {
        $this->orderRepository = $IOrderRepository;
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
        return $this->orderRepository->getOrdersByFilter($date,$todayDate,$status);
    }
}
