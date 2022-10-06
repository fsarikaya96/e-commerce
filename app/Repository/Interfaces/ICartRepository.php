<?php

namespace App\Repository\Interfaces;

use App\Models\Cart;

interface ICartRepository
{
    /**
     * @param array $condition
     * Fetch Cart by Condition
     * @return mixed
     */
    public function getCartByCondition(array $condition):mixed;

    /**
     * @param Cart $cart
     *
     * @return Cart
     */
    public function create(Cart $cart): Cart;
}
