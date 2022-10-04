<?php

namespace App\Repository\Interfaces;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Collection;


interface IProductRepository
{
    /**
     * Get All Products with Paginate Repository
     * @return mixed
     */
    public function getProductWithPaginate(): mixed;

    /**
     * Fetch Product by ID
     *
     * @param int $id
     *
     * @return Product
     */
    public function getProductById(int $id): Product;

    /**
     * @param array $condition
     * @param array $brand
     * @param string|null $price
     *
     * @return mixed
     */
    public function getProductsByCondition(array $condition, array $brand, ?string $price): mixed;

    /**
     * @param Category $category
     * @param Product $product
     * Insert Product Repository
     *
     * @return Product
     */
    public function createWithCategory(Category $category, Product $product): Product;

    /**
     * @param Product $product
     * @param array $colors
     * Create With Colors Repository
     *
     * @return Product
     */
    public function createWithColors(Product $product, array $colors): Product;

    /**
     * @param Product $product
     * @param array $productImages
     * Create With Images Repository
     *
     * @return Product
     */
    public function createWithImages(Product $product, array $productImages): Product;

    /**
     * @param Product $product
     * @param array $productColors
     * Update With Colors Repository
     *
     * @return Product
     */

    public function updateWithColors(Product $product, array $productColors): Product;

    /**
     * @param Product $product
     * @param int $id
     * Update Product Repository
     *
     * @return Product
     */
    public function update(Product $product, int $id);

    /**
     * @param Product $product
     * Delete Product Repository
     *
     * @return mixed
     */
    public function delete(Product $product): bool;

}
