<?php

namespace App\Services\Interfaces;

use App\Models\Wishlist;

interface IWishlistService
{
    /**
     * @param Wishlist $wishlist
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
