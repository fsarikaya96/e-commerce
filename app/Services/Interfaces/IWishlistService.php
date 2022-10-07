<?php

namespace App\Services\Interfaces;

use App\Models\Wishlist;

interface IWishlistService
{
    /**
     * @param Wishlist $wishlist
     * Insert Wishlist Service
     *
     * @return bool
     */
    public function create(Wishlist $wishlist):bool;

    /**
     * Fetch Wishlist by Condition Service
     *
     * @param array $condition
     *
     * @return mixed
     */
    public function getWishlistByCondition(array $condition):mixed;

    /**
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id):bool;

}
