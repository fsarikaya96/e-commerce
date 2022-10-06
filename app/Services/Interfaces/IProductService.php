<?php

namespace App\Services\Interfaces;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Collection;

interface IProductService
{
    /**
     * Get All Products with Paginate Service
     * @return mixed
     */
    public function getProductWithPaginate(): mixed;

    /**
     * @param array $brand
     *
     * @return Product
     */

    /**
     * @param array $condition
     * @param array $brand
     * @param string|null $price
     *
     * @return mixed
     */
    public function getProductsByFilter(array $condition, array $brand, ?string $price):mixed;

    /**
     * @param array $condition
     *
     * @return mixed
     */
    public function getProductsByCondition(array $condition):mixed;

    /**
     * Fetch Product by ID Service
     *
     * @param int $id
     *
     * @return Product
     */
    public function getProductById(int $id): Product;

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
    public function update(ProductRequest $request, int $id);

    /**
     * @param int $id
     * Delete Product Service
     *
     * @return bool
     */
    public function delete(int $id): bool;

}
