<?php

namespace App\Services\Interfaces;

interface ICartService
{
    /**
     * @param array $condition
     * Fetch Cart by Condition
     * @return mixed
     */
    public function getCartByCondition(array $condition):mixed;
}
