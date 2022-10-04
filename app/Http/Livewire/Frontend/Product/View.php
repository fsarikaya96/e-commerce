<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Wishlist;
use App\Services\Interfaces\IWishlistService;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $category, $product, $product_id;

    private IWishlistService $wishlistService;

    public function boot(IWishlistService $IWishlistService)
    {
        $this->wishlistService = $IWishlistService;
    }

    public function addToWishList($product_id)
    {
        if (Auth::check()) {
            $wishlist = new Wishlist();
            $data     = [
                'product_id' => $product_id,
                'user_id'    => auth()->user()->id,
            ];
            if ($this->wishlistService->getWishlistByCondition(['user_id' => auth()->user()->id, 'product_id' => $product_id])->exists()) {
                session()->flash('message', 'Zaten istek listesine eklendi.');
                return false;
            }
            session()->flash('message', 'Favorilere Eklendi.');
            $wishlistData = $wishlist->fill($data);
            return $this->wishlistService->create($wishlistData);
        } else {
            redirect()->to('login');
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
