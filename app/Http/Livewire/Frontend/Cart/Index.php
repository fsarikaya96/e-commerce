<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use App\Services\Interfaces\ICartService;
use Livewire\Component;

class Index extends Component
{
    public $carts;
    private ICartService $cartService;

    public function boot(ICartService $ICartService)
    {
        $this->cartService = $ICartService;
    }

    public function decrementQuantity($cartID)
    {
        $cart = $this->cartService->getCartByCondition(['id' => $cartID, 'user_id' => auth()->user()->id])->first();
        if (!$cart) {
            $this->dispatchBrowserEvent('message', [
                'text'   => 'Bir şeyler yanlış gitti!',
                'type'   => 'error',
                'status' => 404
            ]);
            return false;
        }

        /*if ($cart) {
            if ($cart->quantity > 1) {
                $cart->decrement('quantity');
                $this->dispatchBrowserEvent('message', [
                    'text'   => 'Adet güncellendi.',
                    'type'   => 'success',
                    'status' => 200
                ]);
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text'   => "Miktar 1'den az olamaz",
                    'type'   => 'error',
                    'status' => 200
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text'   => 'Bir şeyler yanlış gitti!',
                'type'   => 'error',
                'status' => 404
            ]);
        }*/
    }

    public function incrementQuantity($cartID)
    {
        $cart = $this->cartService->getCartByCondition(['id' => $cartID,'user_id' => auth()->user()->id])->first();
        if ($cart) {
            if ($cart->productColors){
                if ($cart->productColors->quantity > 0) {

                    if ($cart->quantity <= $cart->productColors->quantity) {
                        $cart->increment('quantity');
                        $this->dispatchBrowserEvent('message', [
                            'text'   => 'Adet güncellendi.',
                            'type'   => 'success',
                            'status' => 200
                        ]);
                    } else {
                        $this->dispatchBrowserEvent('message', [
                            'text'   => $cart->quantity. " adetten fazla olamaz",
                            'type'   => 'error',
                            'status' => 200
                        ]);
                    }
                }
            }else {
                if ($cart->quantity < $cart->products->quantity)
                {
                    $cart->increment('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text'   => 'Adet güncellendi.',
                        'type'   => 'success',
                        'status' => 200
                    ]);
                }else {
                    $this->dispatchBrowserEvent('message', [
                        'text'   => $cart->quantity. " adetten fazla olamaz",
                        'type'   => 'error',
                        'status' => 200
                    ]);
                }
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text'   => 'Bir şeyler yanlış gitti!',
                'type'   => 'error',
                'status' => 404
            ]);
        }
    }

    public function render()
    {
        $this->carts = $this->cartService->getCartByCondition(['user_id' => auth()->user()->id])->get();

        return view('livewire.frontend.cart.index', [
            'carts' => $this->carts
        ]);
    }
}
