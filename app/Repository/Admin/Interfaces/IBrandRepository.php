<?php

namespace App\Repository\Admin\Interfaces;

use App\Models\Brand;
use Illuminate\Support\Collection;

interface IBrandRepository
{
    /**
     * Get All Brands Repository
     * @return mixed
     */
    public function getAllBrands(): mixed;

    /**
     * Fetch categories by status
     * @return mixed
     */
    public function getAllCategories(): Collection;

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
