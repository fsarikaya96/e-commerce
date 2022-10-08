<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Order;
use App\Services\Implementations\OrderService;
use App\Services\Interfaces\ICartService;
use Livewire\Component;

class Index extends Component
{
    public $carts;

    public int $totalPrice = 0;

    public $full_name, $phone, $email, $province, $county, $address;

    private ICartService $cartService;
    private OrderService $orderService;

    public function rules()
    {
        return Order::rules();
    }

    public function boot(ICartService $ICartService, OrderService $IOrderService)
    {
        $this->cartService  = $ICartService;
        $this->orderService = $IOrderService;
    }

    public function mount()
    {
        $this->carts = $this->cartService->getCartByCondition(['user_id' => auth()->user()->id])->get();
    }

    public function removeCart($cartID)
    {
        $this->cartService->delete($cartID);
        $this->emit('CartAddedUpdated');
    }

    public function payOrder()
    {
        $order         = new Order();
        $validatedData = $this->validate();
        $orderData     = $order->fill($validatedData);
        $this->orderService->createOrderWithOrderItems($orderData, $this->carts);
    }

    public function render()
    {
        $this->full_name = auth()->user()->name;
        $this->email     = auth()->user()->email;
        $cartItems       = $this->cartService->getCartByCondition(['user_id' => auth()->user()->id])->get();

        return view('livewire.frontend.checkout.index', [
            'cartItems' => $cartItems
        ]);
    }
}
