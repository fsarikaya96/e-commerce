<?php

namespace App\Services\Implementations;

use App\Models\Wishlist;
use App\Repository\Interfaces\IWishlistRepository;
use App\Services\Interfaces\IWishlistService;

class WishlistService implements IWishlistService
{
    private IWishlistRepository $wishlistRepository;

    public function __construct(IWishlistRepository $IWishlistRepository)
    {
        $this->wishlistRepository = $IWishlistRepository;
    }

    /**
     * @param Wishlist $wishlist
     *
     * @return Wishlist
     */
    public function create(Wishlist $wishlist): Wishlist
    {
      return $this->wishlistRepository->create($wishlist);
    }

    public function getWishlistByCondition(array $condition): mixed
    {
        return $this->wishlistRepository->getWishlistByCondition($condition);
    }
}
