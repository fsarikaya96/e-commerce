<?php

namespace App\Repository\Interfaces;

interface ICartRepository
{
    /**
     * @param array $condition
     * Fetch Cart by Condition
     * @return mixed
     */
    public function getCartByCondition(array $condition):mixed;
}
