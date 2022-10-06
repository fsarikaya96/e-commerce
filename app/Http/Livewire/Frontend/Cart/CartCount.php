<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Services\Interfaces\ICartService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartCount extends Component
{
    public $cartCount;
    protected $listeners = ['CartAddedUpdated' => 'checkCartCount'];
    private ICartService $cartService;

    public function boot(ICartService $ICartService)
    {
        $this->cartService = $ICartService;
    }
    public function checkCartCount()
    {
        if (Auth::check())
        {
            return $this->cartCount = $this->cartService->getCartByCondition(['user_id' => auth()->user()->id])->count();
        }
        return $this->cartCount = 0;
    }
    public function render()
    {
        $this->cartCount = $this->checkCartCount();
        return view('livewire.frontend.cart.cart-count',[
            'cartCount' => $this->cartCount
        ]);
    }
}
