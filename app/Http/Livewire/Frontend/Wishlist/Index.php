<?php

namespace App\Http\Livewire\Frontend\Wishlist;

use App\Models\Wishlist;
use Livewire\Component;

class Index extends Component
{
    public function removeWishlistItem(int $id)
    {
        $wishlist = Wishlist::where('id', $id)->first();
        $this->dispatchBrowserEvent('message', [
            'text'   => 'Favoriden silindi.',
            'type'   => 'success',
            'status' => 200,
        ]);
        $this->emit('wishlistAddedUpdated');
        $wishlist->delete();

    }

    public function render()
    {
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->get();

        return view('livewire.frontend.wishlist.index', [
            'wishlist' => $wishlist
        ]);
    }
}
