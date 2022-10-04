<?php

namespace App\Repository\Interfaces;

use App\Models\Wishlist;

interface IWishlistRepository
{
    /**
     * @param Wishlist $wishlist
     * Insert Wishlist Repository
     *
     * @return Wishlist
     */
    public function create(Wishlist $wishlist):Wishlist;

    /**
     * Fetch Wishlist by Condition
     *
     * @param array $condition
     *
     * @return mixed
     */
    public function getWishlistByCondition(array $condition):mixed;
}
