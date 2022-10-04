<?php

namespace App\Services\Interfaces;

use App\Models\Brand;
use Illuminate\Support\Collection;

interface IBrandService
{
    /**
     * Get All Brands with Paginate Service
     * @return mixed
     */
    public function getBrandsWithPaginate(): mixed;

    /**
     * Fetch categories by Condition
     * @return mixed
     */
    public function getBrandsByCondition(array $condition): Collection;

    /**
     * Insert Brand Service
     *
     * @param Brand $brand
     *
     * @return Brand
     */
    public function create(Brand $brand): Brand;

    /**
     * @param int $id
     * Fetch Brand by ID Service
     *
     * @return Brand
     */
    public function getBrandById(int $id): Brand;

    /**
     * @param Brand $brand
     * @param int $id
     * Update Brand Service
     *
     * @return Brand
     */
    public function update(Brand $brand, int $id): Brand;

    /**
     * @param int $id
     * Delete Brand Service
     *
     * @return bool
     */
    public function delete(int $id): bool;
}
