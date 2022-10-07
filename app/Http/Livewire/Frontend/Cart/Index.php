<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Services\Interfaces\ICartService;
use App\Services\Interfaces\IWishlistService;
use Livewire\Component;

class Index extends Component
{
    public $carts,$totalPrice;

    private ICartService $cartService;

    public function boot(ICartService $ICartService)
    {
        $this->cartService = $ICartService;
    }

    public function decrementQuantity($cartID)
    {
        $cart = $this->cartService->getCartByCondition(['id' => $cartID, 'user_id' => auth()->user()->id])->first();
        if ( ! $cart) {
            $this->dispatchBrowserEvent('message', [
                'text'   => 'Bir şeyler yanlış gitti!',
                'type'   => 'error',
                'status' => 404
            ]);

            return false;
        }
        if ($cart->quantity <= 1) {
            $this->dispatchBrowserEvent('message', [
                'text'   => "Miktar 1'den az olamaz",
                'type'   => 'error',
                'status' => 400
            ]);

            return false;
        }
        // Update Quantity
        $cart->decrement('quantity');
        $this->dispatchBrowserEvent('message', [
            'text'   => 'Adet güncellendi.',
            'type'   => 'success',
            'status' => 200
        ]);

        return true;
    }

    public function incrementQuantity($cartID)
    {
        $cart = $this->cartService->getCartByCondition(['id' => $cartID, 'user_id' => auth()->user()->id])->first();
        if ( ! $cart) {
            $this->dispatchBrowserEvent('message', [
                'text'   => 'Bir şeyler yanlış gitti!',
                'type'   => 'error',
                'status' => 404
            ]);

            return false;
        }
        if ($cart->productColors) {
            if ($cart->quantity >= $cart->productColors->quantity) {
                $this->dispatchBrowserEvent('message', [
                    'text'   => "Miktar " . $cart->quantity . "'den fazla olamaz",
                    'type'   => 'error',
                    'status' => 400
                ]);

                return false;
            }
            // Update Quantity
        } else {
            if ($cart->quantity >= $cart->products->quantity) {
                $this->dispatchBrowserEvent('message', [
                    'text'   => "Miktar " . $cart->quantity . "'den fazla olamaz",
                    'type'   => 'error',
                    'status' => 400
                ]);

                return false;
            }
        }
        $cart->increment('quantity');
        $this->dispatchBrowserEvent('message', [
            'text'   => 'Adet güncellendi.',
            'type'   => 'success',
            'status' => 200
        ]);

        return true;
    }

    public function removeCart($cartID)
    {
        $cart = $this->cartService->getCartByCondition(['id' => $cartID, 'user_id' => auth()->user()->id])->first();

        if(!$cart)
        {
            $this->dispatchBrowserEvent('message', [
                'text'   => 'Bir şeyler yanlış gitti!',
                'type'   => 'error',
                'status' => 404
            ]);
            return false;
        }
        $this->emit('CartAddedUpdated');
        $cart->delete();
        $this->dispatchBrowserEvent('message', [
            'text'   => 'Başarıyla silindi',
            'type'   => 'success',
            'status' => 200
        ]);
        return true;
    }

    public function render()
    {
        $this->carts = $this->cartService->getCartByCondition(['user_id' => auth()->user()->id])->get();

        return view('livewire.frontend.cart.index', [
            'carts' => $this->carts
        ]);
    }
}
