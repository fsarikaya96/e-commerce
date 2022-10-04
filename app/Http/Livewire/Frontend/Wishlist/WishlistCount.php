<?php

namespace App\Http\Livewire\Frontend\Wishlist;

use App\Models\Wishlist;
use App\Services\Interfaces\IWishlistService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistCount extends Component
{
    public $wishlistCount;
    protected $listeners = ['wishlistAddedUpdated' => 'checkWishlistCount'];
    private IWishlistService $wishlistService;

    public function boot(IWishlistService $IWishlistService)
    {
        $this->wishlistService = $IWishlistService;
    }

    public function checkWishlistCount()
    {
        if (Auth::check()) {
            return $this->wishlistCount = $this->wishlistService->getWishlistByCondition(['user_id' => auth()->user()->id])->count();
        } else {
            return $this->wishlistCount = 0;
        }
    }

    public function render()
    {
        $this->wishlistCount = $this->checkWishlistCount();

        return view('livewire.frontend.wishlist.wishlist-count', [
            'wishlistCount' => $this->wishlistCount
        ]);
    }
}
