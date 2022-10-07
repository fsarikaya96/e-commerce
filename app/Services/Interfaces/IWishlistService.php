<?php

namespace App\Services\Interfaces;

use App\Models\Wishlist;
use Flasher\Prime\FlasherInterface;

interface IWishlistService
{
    /**
     * @param Wishlist $wishlist
     * Insert Wishlist Service
     * @return Wishlist
     */
    public function create(Wishlist $wishlist):Wishlist;

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
