<?php

namespace App\Services\Interfaces;

use App\Models\Cart;

interface ICartService
{
    /**
     * @param array $condition
     * Fetch Cart by Condition
     * @return mixed
     */
    public function getCartByCondition(array $condition):mixed;

    /**
     * @param array $cartData
     *
     * @return Cart
     */
    public function create(array $cartData):Cart;
}
