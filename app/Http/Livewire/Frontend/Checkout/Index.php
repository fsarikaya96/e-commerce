<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\Interfaces\ICartService;
use Illuminate\Support\Str;
use Livewire\Component;

class Index extends Component
{
    public $carts;

    public int $totalPrice = 0;

    public $full_name, $phone, $email, $province, $county, $address,$paymentMode = null,$payment_id = null;

    private ICartService $cartService;

    public function rules()
    {
        return Order::rules();
    }

    public function boot(ICartService $ICartService)
    {
        $this->cartService = $ICartService;
    }

    public function mount()
    {
        $this->carts = $this->cartService->getCartByCondition(['user_id' => auth()->user()->id])->get();
    }

    public function removeCart($cartID)
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
        $this->emit('CartAddedUpdated');
        $cart->delete();
        $this->dispatchBrowserEvent('message', [
            'text'   => 'Başarıyla silindi',
            'type'   => 'success',
            'status' => 200
        ]);

        return true;
    }

    public function placeOrder()
    {
        $this->validate();

        $order = Order::create([
            'user_id'        => auth()->user()->id,
            'tracking_no'    => 'jfeel-' . Str::random(10),
            'full_name'      => $this->full_name,
            'email'          => $this->email,
            'phone'          => $this->phone,
            'province'       => $this->province,
            'county'         => $this->county,
            'address'        => $this->address,
            'status_message' => 'in progress',
            'payment_mode'   => $this->paymentMode,
            'payment_id'     => $this->payment_id,
        ]);
        foreach ($this->carts as $cart) {
            $orderItem = OrderItem::create([
                'order_id'         => $order->id,
                'product_id'       => $cart->product_id,
                'product_color_id' => $cart->product_color_id,
                'quantity'         => $cart->quantity,
                'price'            => $cart->products->selling_price
            ]);
            if ($cart->product_color_id != null)
            {
                $cart->productColors()->where('id',$cart->product_color_id)->decrement('quantity',$cart->quantity);
            }else {
                $cart->products()->where('id',$cart->product_id)->decrement('quantity',$cart->quantity);
            }
        }
        return $order;
    }

    public function codOrder()
    {
        $this->paymentMode = 'Cash on Delivery';
        $codOrder = $this->placeOrder();
        if ($codOrder) {
            $this->cartService->getCartByCondition(['user_id' => auth()->user()->id])->delete();
            $this->dispatchBrowserEvent('message', [
                'text'   => 'Ödeme Başarılı!',
                'type'   => 'success',
                'status' => 200
            ]);
            return redirect()->to('thank-you');
        }else {
            $this->dispatchBrowserEvent('message', [
                'text'   => 'Bir şeyler yanlış gitti!',
                'type'   => 'error',
                'status' => 500
            ]);
        }
        return true;
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
