<?php

namespace App\Services\Interfaces;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface IProductService
{
    /**
     * Get All Products with Paginate Service
     * @return mixed
     */
    public function getProductsWithPaginate(): mixed;

    /**
     * @param array $condition
     * @param array $brand
     * @param string|null $price
     *
     * @return mixed
     */
    public function getProductsByFilter(array $condition, array $brand, ?string $price): mixed;

    /**
     * @param array $condition
     * Fetch Products by Condition Service
     *
     * @return mixed
     */
    public function getProductsByCondition(array $condition): mixed;

    /**
     * Fetch Product by ID Service
     *
     * @param int $id
     *
     * @return Product
     */
    public function getProductById(int $id): Product;

    /**
     * Fetch Product Image by ID Service
     *
     * @param int $id
     *
     * @return ProductImage
     */
    public function getProductImageById(int $id): ProductImage;

    /**
     * Fetch Product Color by ID Service
     *
     * @param int $id
     *
     * @return ProductColor
     */
    public function getProductColorById(int $id): ProductColor;

    /**
     * Fetch Product Color by ID Service
     *
     * @param int $productID
     * @param int $productColorID
     *
     * @return ProductColor
     */
    public function getProductColorByCondition(int $productID, int $productColorID): ProductColor;

    /**
     * @param ProductRequest $request
     * Create Product Service
     *
     * @return Product
     */
    public function create(ProductRequest $request): Product;

    /**
     * @param ProductRequest $request
     * @param int $id
     * Update Product Service
     *
     * @return mixed
     */
    public function update(ProductRequest $request, int $id): Product;

    /**
     * @param int $id
     * Delete Product Service
     *
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * @param int $imageID
     * Delete Product Images Service
     *
     * @return bool
     */
    public function deleteProductImages(int $imageID): bool;

    /**
     * @param Request $request
     * @param int $id
     * Update Product Colors Service
     * @return ProductColor
     */
    public function updateProductColors(Request $request, int $id): ProductColor;

    /**
     * @param int $colorID
     * Delete Product Color Service
     * @return bool
     */
    public function deleteProductColor(int $colorID): bool;


}
