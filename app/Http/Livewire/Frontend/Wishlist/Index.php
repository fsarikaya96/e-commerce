<?php

namespace App\Http\Livewire\Frontend\Wishlist;

use App\Services\Interfaces\IWishlistService;
use Livewire\Component;

class Index extends Component
{
    private IWishlistService $wishlistService;

    public function boot(IWishlistService $IWishlistService)
    {
        $this->wishlistService = $IWishlistService;
    }

    public function removeWishlistItem(int $id)
    {
        $this->wishlistService->delete($id);
        $this->emit('wishlistAddedUpdated');
    }

    public function render()
    {
        $wishlist = $this->wishlistService->getWishlistByCondition(['user_id' => auth()->user()->id])->get();

        return view('livewire.frontend.wishlist.index', [
            'wishlist' => $wishlist
        ]);
    }
}
