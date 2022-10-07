<?php

namespace App\Repository\Implementations;

use App\Models\Wishlist;
use App\Repository\Interfaces\IWishlistRepository;

class WishlistRepository implements IWishlistRepository
{
    /**
     * @param Wishlist $wishlist
     * Insert Wishlist Repository
     *
     * @return Wishlist
     */
    public function create(Wishlist $wishlist): Wishlist
    {
        $wishlist->save();

        return $wishlist;
    }

    /**
     * @param array $condition
     * Fetch Wishlist by Condition Repository
     *
     * @return mixed
     */
    public function getWishlistByCondition(array $condition): mixed
    {
        return Wishlist::where($condition);
    }

    /**
     * @param Wishlist $wishlist
     *
     * @return bool
     */
    public function delete(Wishlist $wishlist): bool
    {
        return $wishlist->delete();
    }
}
