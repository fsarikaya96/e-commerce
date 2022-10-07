<?php

namespace App\Repository\Interfaces;

interface IOrderRepository
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
}
