<?php

namespace App\Repository\Implementations;

use App\Models\Cart;
use App\Repository\Interfaces\ICartRepository;

class CartRepository implements ICartRepository
{

    public function getCartByCondition(array $condition): mixed
    {
        return Cart::where($condition);
    }

    public function create(Cart $cart): Cart
    {
        $cart->save();

        return $cart;
    }

    public function decrementQuantity(int $id): bool
    {
        $cart = Cart::findOrFail($id);

        return $cart->decrement('quantity');
    }

    public function incrementQuantity(int $id): bool
    {
        $cart = Cart::findOrFail($id);

        return $cart->increment('quantity');
    }
    public function delete(Cart $cart): bool
    {
        return $cart->delete();
    }
}
