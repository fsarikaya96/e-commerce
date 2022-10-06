<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Wishlist;
use App\Services\Implementations\ProductService;
use App\Services\Interfaces\ICartService;
use App\Services\Interfaces\IProductService;
use App\Services\Interfaces\IWishlistService;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $category, $product, $product_id, $quantityCount = 1, $productColorSelected, $productColorID;

    private IWishlistService $wishlistService;
    private ICartService $cartService;
    private ProductService $productService;

    public function boot(
        IWishlistService $IWishlistService,
        ICartService $ICartService,
        IProductService $IProductService
    ) {
        $this->wishlistService = $IWishlistService;
        $this->cartService     = $ICartService;
        $this->productService  = $IProductService;
    }

    public function colorSelected($productColorID)
    {
        $this->productColorID       = $productColorID;
        $productColor               = $this->product->productColors()->where('id', $productColorID)->first();
        $this->productColorSelected = $productColor->colors->name;
    }

    public function addToCart($productID)
    {
        // Check user
        if ( ! Auth::check()) {
            $this->dispatchBrowserEvent('message', [
                'text'   => 'Lütfen giriş yapınız.',
                'type'   => 'info',
                'status' => 401
            ]);

            return false;
        }
        // Check product
        if ( ! $this->productService->getProductsByCondition(['id' => $productID, 'status' => 1], [], "")->exists()) {
            $this->dispatchBrowserEvent('message', [
                'text'   => 'Ürün mevcut değil.',
                'type'   => 'info',
                'status' => 401
            ]);

            return false;
        }
        // Check product color count
        if ($this->product->productColors()->count() > 1) {
            // Check product selected
            if ($this->productColorSelected == null) {
                $this->dispatchBrowserEvent('message', [
                    'text'   => 'Renk Seçiniz.',
                    'type'   => 'info',
                    'status' => 401
                ]);
                return false;
            }
            // Check Product with color add to cart
            if ($this->cartService->getCartByCondition([
                'user_id' => auth()->user()->id,
                'product_id' => $productID,
                'product_color_id' => $this->productColorID
            ])->exists()) {
                $this->dispatchBrowserEvent('message', [
                    'text'   => 'Ürün zaten sepete eklendi.',
                    'type'   => 'info',
                    'status' => 401
                ]);
                return false;
            }

            $productColor = $this->product->productColors()->where('id', $this->productColorID)->first();
            // Check product color to input quantity
            if(  $productColor->quantity < $this->quantityCount) {
                $this->dispatchBrowserEvent('message', [
                    'text'   => $productColor->colors->name . ' Renkten ' . $productColor->quantity . ' adet mevcuttur.',
                    'type'   => 'info',
                    'status' => 401
                ]);
                return false;
            }
            // Insert product with color
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
            if (  $this->product->quantity< 0) {
                $this->dispatchBrowserEvent('message', [
                    'text'   => 'Stota Yok.',
                    'type'   => 'info',
                    'status' => 401
                ]);
                return false;
            }
        }else {
            // Check Product without color add to cart
            if ($this->cartService->getCartByCondition(['user_id' => auth()->user()->id, 'product_id' => $productID])->exists()) {
                $this->dispatchBrowserEvent('message', [
                    'text'   => 'Ürün zaten sepete eklendi.',
                    'type'   => 'info',
                    'status' => 401
                ]);
                return false;
            }

            if ( ! $this->product->quantity > 0) {
                $this->dispatchBrowserEvent('message', [
                    'text'   => 'Stokta Yok',
                    'type'   => 'info',
                    'status' => 401
                ]);
                return false;
            }
                if ( $this->product->quantity < $this->quantityCount) {
                    $this->dispatchBrowserEvent('message', [
                        'text'   => 'Bu üründen sadece  ' . $this->product->quantity . ' adet mevcuttur.',
                        'type'   => 'info',
                        'status' => 401
                    ]);
                    return false;
                }
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
        }
        return true;
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
