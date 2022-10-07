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
     * @param FlasherInterface $flasher
     */
    public function __construct(IWishlistRepository $IWishlistRepository, FlasherInterface $flasher)
    {
        $this->wishlistRepository = $IWishlistRepository;
        $this->flasher = $flasher;
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
        $this->flasher->addSuccess('Favoriden silindi!');
        $wishlist = $this->wishlistRepository->getWishlistByCondition(['id' => $id])->first();
        return $this->wishlistRepository->delete($wishlist);

    }
}
