<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\Interfaces\ICartService;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Str;
use Livewire\Component;

class Index extends Component
{
    public $carts;

    public int $totalPrice = 0;

    public $full_name, $phone, $email, $province, $county, $address;

    private ICartService $cartService;
    private FlasherInterface $flasher;

    public function rules()
    {
        return Order::rules();
    }

    public function boot(ICartService $ICartService, FlasherInterface $IFlasher)
    {
        $this->cartService = $ICartService;
        $this->flasher = $IFlasher;
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
        ]);
        foreach ($this->carts as $cart) {
              OrderItem::create([
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
        if ($order) {
            $this->cartService->getCartByCondition(['user_id' => auth()->user()->id])->delete();
            $this->flasher->addSuccess('Ödeme Başarılı!');

            return redirect()->to('thank-you');
        }else {
            $this->flasher->addError('Bir şeyler yanlış gitti!');
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
