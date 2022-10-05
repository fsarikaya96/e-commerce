<?php

namespace App\Services\Implementations;

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
}
