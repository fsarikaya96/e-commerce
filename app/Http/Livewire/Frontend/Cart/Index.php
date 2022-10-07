<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Services\Interfaces\ICartService;
use App\Services\Interfaces\IWishlistService;
use Livewire\Component;

class Index extends Component
{
    public $carts, $totalPrice;

    private ICartService $cartService;

    public function boot(ICartService $ICartService)
    {
        $this->cartService = $ICartService;
    }

    public function decrementQuantity($cartID)
    {
        $this->cartService->decrement($cartID);
    }

    public function incrementQuantity($cartID)
    {
        $this->cartService->increment($cartID);
    }

    public function removeCart($cartID)
    {
        $this->cartService->delete($cartID);
        $this->emit('CartAddedUpdated');
    }

    public function render()
    {
        $this->carts = $this->cartService->getCartByCondition(['user_id' => auth()->user()->id])->get();

        return view('livewire.frontend.cart.index', [
            'carts' => $this->carts
        ]);
    }
}
