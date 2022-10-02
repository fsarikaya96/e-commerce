<?php

namespace App\Repository\Admin\Implementations;

use App\Models\Brand;
use App\Models\Category;
use App\Repository\Admin\Interfaces\IBrandRepository;
use Illuminate\Support\Collection;

class BrandRepository implements IBrandRepository
{
    /**
     * Get All Brands
     * @return mixed
     */
    public function getAllBrands()
    {
        return Brand::orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * Fetch categories by status
     * @return mixed
     */
    public function getAllCategories(): Collection
    {
        return Category::where('status', 1)->get();
    }

    /**
     * Insert Brand
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
     *
     * @return Brand
     */
    public function update(Brand $brand, int $id): Brand
    {
        $brand->save();

        return $brand;
    }

    public function delete(Brand $brand): bool
    {
        return $brand->delete();
    }
}
