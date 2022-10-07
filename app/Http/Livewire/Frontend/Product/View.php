<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Wishlist;
use App\Services\Implementations\ProductService;
use App\Services\Interfaces\ICartService;
use App\Services\Interfaces\IProductService;
use App\Services\Interfaces\IWishlistService;

use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $category, $product, $product_id, $quantityCount = 1, $productColorSelected, $productColorID;

    private IWishlistService $wishlistService;
    private ICartService $cartService;
    private ProductService $productService;
    private FlasherInterface $flasher;

    public function boot(
        IWishlistService $IWishlistService,
        ICartService $ICartService,
        IProductService $IProductService,
        FlasherInterface $IFlasher,
    ) {
        $this->wishlistService = $IWishlistService;
        $this->cartService     = $ICartService;
        $this->productService  = $IProductService;
        $this->flasher         = $IFlasher;
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
            $this->flasher->addError('Lütfen giriş yapınız!');

            return false;
        }
        $productData      = [
            'user_id'    => auth()->user()->id,
            'product_id' => $productID,
            'quantity'   => $this->quantityCount
        ];
        $productColorData = ['product_color_id' => $this->productColorID];
        $data             = array_merge($productData, $productColorData);
        // Check product
        if ( ! $this->productService->getProductsByCondition(['id' => $productID, 'status' => 1])->exists()) {
            $this->flasher->addError('Ürün mevcut değil!');

            return false;
        }
        // Check product color count
        if ($this->product->productColors()->count() > 1) {
            // Check product selected
            if ($this->productColorSelected == null) {
                $this->flasher->addError('Renk Seçiniz!');

                return false;
            }
            // Check Product with color add to cart
            if ($this->cartService->getCartByCondition([
                'user_id'          => auth()->user()->id,
                'product_id'       => $productID,
                'product_color_id' => $this->productColorID
            ])->exists()) {
                $this->flasher->addError('Ürün zaten sepete eklendi!');

                return false;
            }

            $productColor = $this->product->productColors()->where('id', $this->productColorID)->first();
            // Check product color to input quantity
            if ($productColor->quantity < $this->quantityCount) {
                $this->flasher->addError(
                    $productColor->colors->name . ' Renkten ' . $productColor->quantity . ' adet mevcuttur!'
                );

                return false;
            }
            // Insert product with color
            $this->cartService->create($data);
            $this->emit('CartAddedUpdated');
            $this->flasher->addSuccess('Sepete Eklendi!');

            if ($this->product->quantity < 0) {
                $this->flasher->addError('Stota Yok!');

                return false;
            }
        } else {
            // Check Product without color add to cart
            if ($this->cartService->getCartByCondition(['user_id' => auth()->user()->id, 'product_id' => $productID]
            )->exists()) {
                $this->flasher->addError('Ürün zaten sepete eklendi!');

                return false;
            }

            if ( ! $this->product->quantity > 0) {
                $this->flasher->addError('Stokta Yok!');

                return false;
            }
            if ($this->product->quantity < $this->quantityCount) {
                $this->flasher->addError('Bu üründen sadece  ' . $this->product->quantity . ' adet mevcuttur!');

                return false;
            }
            // Insert Product without color
            $this->cartService->create($data);
            $this->emit('CartAddedUpdated');
            $this->flasher->addSuccess('Sepete Eklendi!');
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
        if ( ! Auth::check()) {
            $this->flasher->addError('Lütfen giriş yapınız!');

            return false;
        }
        $wishlist = new Wishlist();
        $data     = [
            'product_id' => $product_id,
            'user_id'    => auth()->user()->id,
        ];
        $this->emit('wishlistAddedUpdated');
        $wishlistData = $wishlist->fill($data);

        return $this->wishlistService->create($wishlistData);
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
