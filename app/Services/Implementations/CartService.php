<?php

namespace App\Services\Implementations;

use App\Models\Cart;
use App\Repository\Interfaces\ICartRepository;
use App\Services\Interfaces\ICartService;

class CartService implements ICartService
{
    private ICartRepository $cartRepository;

    public function __construct(ICartRepository $ICartRepository)
    {
        $this->cartRepository = $ICartRepository;
    }

    /**
     * @param array $condition
     *
     * @return mixed
     */
    public function getCartByCondition(array $condition): mixed
    {
        return $this->cartRepository->getCartByCondition($condition);
    }

    /**
     * @param array $cartData
     *
     * @return Cart
     */
    public function create(array $cartData): Cart
    {
        $cart = new Cart();
        $cart->fill($cartData);
        return $this->cartRepository->create($cart);
    }
}
