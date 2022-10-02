<?php

namespace App\Services\Admin\Interfaces;

use App\Models\Brand;
use Illuminate\Support\Collection;

interface IBrandService
{
    /**
     * Get All Brands
     * @return mixed
     */
    public function getAllBrands();

    /**
     * fetch categories by status
     * @return mixed
     */
    public function getAllCategories():Collection;

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
     * Get Brand By ID
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
