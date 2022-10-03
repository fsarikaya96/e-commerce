<?php

namespace App\Repository\Admin\Interfaces;

use App\Models\Brand;
use Illuminate\Support\Collection;

interface IBrandRepository
{
    /**
     * Get All Brands with Paginate Repository
     * @return mixed
     */
    public function getBrandsWithPaginate(): mixed;

    /**
     * Fetch Brands by Condition
     * @return mixed
     */
    public function getBrandsByCondition(array $condition): Collection;

    /**
     * @param Brand $brand
     * Insert Brand
     *
     * @return Brand
     */
    public function create(Brand $brand): Brand;

    /**
     * @param int $id
     * Fetch Brand by ID
     *
     * @return Brand
     */
    public function getBrandById(int $id): Brand;

    /**
     * @param Brand $brand
     * @param int $id
     * Update Brand
     *
     * @return Brand
     */
    public function update(Brand $brand, int $id): Brand;

    /**
     * @param Brand $brand
     * Delete Brand
     *
     * @return bool
     */
    public function delete(Brand $brand): bool;
}
