<?php

namespace App\Services\Implementations;

use App\Models\Wishlist;
use App\Repository\Interfaces\IWishlistRepository;
use App\Services\Interfaces\IWishlistService;
use Flasher\Prime\FlasherInterface;

class WishlistService implements IWishlistService
{
    private IWishlistRepository $wishlistRepository;
    private FlasherInterface $flasher;

    /**
     * Wishlist construct injection
     *
     * @param IWishlistRepository $IWishlistRepository
     * @param FlasherInterface $IFlasher
     */
    public function __construct(IWishlistRepository $IWishlistRepository, FlasherInterface $IFlasher)
    {
        $this->wishlistRepository = $IWishlistRepository;
        $this->flasher = $IFlasher;
    }

    /**
     * @param Wishlist $wishlist
     *
     * @return bool
     */
    public function create(Wishlist $wishlist): bool
    {
        if ($this->wishlistRepository->getWishlistByCondition(['user_id' => auth()->user()->id, 'product_id' => $wishlist->product_id])->exists()) {
            $this->flasher->addError('Zaten favorilere eklendi!');
            return false;
        }
        $this->flasher->addSuccess('Favorilere eklendi!');
        $this->wishlistRepository->create($wishlist);
        return true;
    }

    /**
     * @param array $condition
     *
     * @return mixed
     */
    public function getWishlistByCondition(array $condition): mixed
    {
        return $this->wishlistRepository->getWishlistByCondition($condition);
    }

    public function delete(int $id): bool
    {
        $wishlist = $this->wishlistRepository->getWishlistByCondition(['id' => $id])->first();
        $this->flasher->addSuccess('Favoriden silindi!');
        return $this->wishlistRepository->delete($wishlist);
    }
}
