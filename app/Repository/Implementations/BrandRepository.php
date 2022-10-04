<?php

namespace App\Repository\Implementations;

use App\Models\Brand;
use App\Repository\Interfaces\IBrandRepository;
use Illuminate\Support\Collection;

class BrandRepository implements IBrandRepository
{
    /**
     * Get All Brands with Paginate Repository
     * @return mixed
     */
    public function getBrandsWithPaginate(): mixed
    {
        return Brand::orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * Fetch categories by Condition Repository
     * @return mixed
     */
    public function getBrandsByCondition(array $condition): Collection
    {
        return Brand::where($condition)->get();
    }

    /**
     * Insert Brand Repository
     *
     * @param Brand $brand
     *
     * @return Brand
     */
    public function create(Brand $brand): Brand
    {
        $brand->status = $brand->status ? 1 : 0;

        $brand->save();

        return $brand;
    }

    /**
     * @param int $id
     * Fetch Brand by ID Repository
     *
     * @return Brand
     */
    public function getBrandById(int $id): Brand
    {
        return Brand::findOrFail($id);
    }

    /**
     * @param Brand $brand
     * @param int $id
     * Update Brand Repository
     *
     * @return Brand
     */
    public function update(Brand $brand, int $id): Brand
    {
        $brand->save();

        return $brand;
    }

    /**
     * @param Brand $brand
     * Delete Brand Repository
     *
     * @return bool
     */
    public function delete(Brand $brand): bool
    {
        return $brand->delete();
    }
}
