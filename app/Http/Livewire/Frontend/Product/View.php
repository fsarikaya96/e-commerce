<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Wishlist;
use App\Services\Interfaces\IWishlistService;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $category, $product, $product_id, $quantityCount = 1, $productColorSelected, $productColorID;

    private IWishlistService $wishlistService;

    public function boot(IWishlistService $IWishlistService)
    {
        $this->wishlistService = $IWishlistService;
    }

    public function colorSelected($productColorID)
    {
        $this->productColorID       = $productColorID;
        $productColor               = $this->product->productColors()->where('id', $productColorID)->first();
        $this->productColorSelected = $productColor->colors->name;
    }

    public function addToCart($productID)
    {
        if (Auth::check()) {
            if ($this->product->where('id', $productID)->where('status', 1)->exists()) {
                // Check product color quantity and add to cart
                if ($this->product->productColors()->count() > 1) {
                    // If the color is not blank
                    if ($this->productColorSelected != null) {
                        $productColor = $this->product->productColors()->where('id', $this->productColorID)->first();
                        // If the quantity of colors is greater than 0
                        if ($productColor->quantity > 0) {
                            if ($productColor->quantity >= $this->quantityCount) {
                                // Insert Product with color
                                Cart::create([
                                    'user_id'          => auth()->user()->id,
                                    'product_id'       => $productID,
                                    'product_color_id' => $this->productColorID,
                                    'quantity'         => $this->quantityCount
                                ]);
                                $this->dispatchBrowserEvent('message', [
                                    'text'   => 'Sepete Eklendi.',
                                    'type'   => 'success',
                                    'status' => 200
                                ]);
                            } else {
                                $this->dispatchBrowserEvent('message', [
                                    'text'   => $productColor->colors->name . ' Renkten ' . $productColor->quantity . ' adet mevcuttur.',
                                    'type'   => 'info',
                                    'status' => 401
                                ]);
                            }
                        } else {
                            $this->dispatchBrowserEvent('message', [
                                'text'   => 'Stokta Yok.',
                                'type'   => 'info',
                                'status' => 401
                            ]);
                        }
                    } else {
                        $this->dispatchBrowserEvent('message', [
                            'text'   => 'Renk Seçiniz.',
                            'type'   => 'info',
                            'status' => 401
                        ]);
                    }
                } // Check Product without color add to cart
                else {
                    if ($this->product->quantity > 0) {
                        if ($this->product->quantity > $this->quantityCount) {
                            // Insert Product without color
                            Cart::create([
                                'user_id'    => auth()->user()->id,
                                'product_id' => $productID,
                                'quantity'   => $this->quantityCount
                            ]);
                            $this->dispatchBrowserEvent('message', [
                                'text'   => 'Sepete Eklendi.',
                                'type'   => 'success',
                                'status' => 200
                            ]);
                        } else {
                            $this->dispatchBrowserEvent('message', [
                                'text'   => 'sadece' . $this->product->quantity . 'adet mevcuttur.',
                                'type'   => 'info',
                                'status' => 401
                            ]);
                        }
                    } else {
                        $this->dispatchBrowserEvent('message', [
                            'text'   => 'Stokta Yok.',
                            'type'   => 'info',
                            'status' => 401
                        ]);
                    }
                }
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text'   => 'Ürün mevcut değil.',
                    'type'   => 'info',
                    'status' => 401
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text'   => 'Lütfen giriş yapınız.',
                'type'   => 'info',
                'status' => 401
            ]);
        }
    }

    public function incrementQuantity()
    {
        if ($this->quantityCount < 20) {
            $this->quantityCount++;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantityCount > 1) {
            $this->quantityCount--;
        }
    }

    public function addToWishList($product_id)
    {
        if (Auth::check()) {
            $wishlist = new Wishlist();
            $data     = [
                'product_id' => $product_id,
                'user_id'    => auth()->user()->id,
            ];
            if ($this->wishlistService->getWishlistByCondition(
                ['user_id' => auth()->user()->id, 'product_id' => $product_id]
            )->exists()) {
                $this->dispatchBrowserEvent('message', [
                    'text'   => 'Zaten favorilere eklendi.',
                    'type'   => 'warning',
                    'status' => 409
                ]);

                return false;
            }
            $this->emit('wishlistAddedUpdated');
            $this->dispatchBrowserEvent('message', [
                'text'   => 'Favorilere eklendi.',
                'type'   => 'success',
                'status' => 200
            ]);
            $wishlistData = $wishlist->fill($data);

            return $this->wishlistService->create($wishlistData);
        } else {
            $this->dispatchBrowserEvent('message', [
                'text'   => 'Lütfen giriş yapınız.',
                'type'   => 'info',
                'status' => 401
            ]);

            return false;
        }
    }

    public function mount($category, $product)
    {
        $this->category = $category;
        $this->product  = $product;
    }

    public function render()
    {
        return view(
            'livewire.frontend.product.view',
            ['product' => $this->product],
            ['category' => $this->category]
        );
    }
}
