<?php

namespace App\Services\Admin\Interfaces;

use App\Models\Brand;
use Illuminate\Support\Collection;

interface IBrandService
{
    /**
     * Get All Brands with Paginate Repository
     * @return mixed
     */
    public function getBrandsWithPaginate(): mixed;

    /**
     * Fetch categories by Condition
     * @return mixed
     */
    public function getBrandsByCondition(array $condition): Collection;

    /**
     * Insert Brand
     *
     * @param Brand $brand
     *
     * @return Brand
     */
    public function create(Brand $brand):Brand;

    /**
     * @param int $id
     * Fetch Brand by ID
     * @return Brand
     */
    public function getBrandById(int $id) :Brand;

    /**
     * @param Brand $brand
     * @param int $id
     * Update Brand
     *
     * @return Brand
     */
    public function update(Brand $brand, int $id):Brand;

    /**
     * @param int $id
     * Delete Brand
     * @return bool
     */
    public function delete(int $id):bool;
}
