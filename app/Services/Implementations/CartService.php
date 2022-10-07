<?php

namespace App\Services\Implementations;

use App\Models\Cart;
use App\Repository\Interfaces\ICartRepository;
use App\Repository\Interfaces\IProductRepository;
use App\Services\Interfaces\ICartService;
use Flasher\Prime\FlasherInterface;

class CartService implements ICartService
{
    private ICartRepository $cartRepository;
    private FlasherInterface $flasher;

    public function __construct(ICartRepository $ICartRepository, FlasherInterface $IFlasher)
    {
        $this->cartRepository = $ICartRepository;
        $this->flasher        = $IFlasher;
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

    /**
     * @param int $cartID
     *
     * @return bool
     */
    public function decrement(int $cartID):bool
    {
        $cart = $this->cartRepository->getCartByCondition(['id' => $cartID, 'user_id' => auth()->user()->id])->first();
        if ( ! $cart) {
            $this->flasher->addError('Bir şeyler yanlış gitti!');

            return false;
        }
        if ($cart->quantity <= 1) {
            $this->flasher->addError("Miktar 1'den az olamaz!");

            return false;
        }
        // Update Quantity
        $this->flasher->addSuccess("Adet güncellendi!");

        return $this->cartRepository->decrementQuantity($cart->id);
    }

    /**
     * @param int $cartID
     *
     * @return bool
     */
    public function increment(int $cartID):bool
    {
        $cart = $this->cartRepository->getCartByCondition(['id' => $cartID, 'user_id' => auth()->user()->id])->first();
        if ( ! $cart) {
            $this->flasher->addError('Bir şeyler yanlış gitti!');

            return false;
        }
        if ($cart->productColors) {
            if ($cart->quantity >= $cart->productColors->quantity) {
                $this->flasher->addError("Miktar " . $cart->quantity . "'den fazla olamaz!");

                return false;
            }
            // Update Quantity
        } else {
            if ($cart->quantity >= $cart->products->quantity) {
                $this->flasher->addError("Miktar " . $cart->quantity . "'den fazla olamaz");

                return false;
            }
        }

        // Update Quantity
        $this->flasher->addSuccess("Adet güncellendi!");

        return $this->cartRepository->incrementQuantity($cart->id);
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        $cart = $this->getCartByCondition(['id' => $id, 'user_id' => auth()->user()->id])->first();
        $this->flasher->addSuccess('Sepetten silindi!');

        return $this->cartRepository->delete($cart);
    }
}
