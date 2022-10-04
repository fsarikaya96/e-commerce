<?php

namespace App\Services\Interfaces;

use App\Http\Requests\ProductRequest;
use App\Models\Product;

interface IProductService
{
    /**
     * Get All Products with Paginate Service
     * @return mixed
     */
    public function getProductWithPaginate(): mixed;

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
