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

    /**
     * @param int $cartID
     *
     * @return mixed
     */
    public function decrement(int $cartID):bool;

    /**
     * @param int $cartID
     *
     * @return mixed
     */
    public function increment(int $cartID):bool;

    /**
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id):bool;
}
