<?php

namespace App\Repository\Interfaces;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;


interface IProductRepository
{
    /**
     * Get All Products with Paginate Repository
     * @return mixed
     */
    public function getProductsWithPaginate(): mixed;

    /**
     * @param array $condition
     * @param array $brand
     * @param string|null $price
     * Get Products by Filter Repository
     * @return mixed
     */
    public function getProductsByFilter(array $condition, array $brand, ?string $price): mixed;

    /**
     * @param array $condition
     *
     * @return mixed
     */
    public function getProductsByCondition(array $condition): mixed;

    /**
     * Fetch Product by ID Repository
     *
     * @param int $id
     *
     * @return Product
     */
    public function getProductById(int $id): Product;

    /**
     * Fetch Product Image by ID Repository
     *
     * @param int $id
     *
     * @return ProductImage
     */

    public function getProductImageById(int $id): ProductImage;

    /**
     * Fetch Product Color By ID Repository
     *
     * @param int $id
     *
     * @return ProductColor
     */
    public function getProductColorById(int $id): ProductColor;

    /**
     * Fetch Product Color by Condition Repository
     *
     * @param int $productID
     * @param int $productColorID
     *
     * @return ProductColor
     */
    public function getProductColorByCondition(int $productID, int $productColorID): ProductColor;

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
     * Update Product Repository
     *
     * @return Product
     */
    public function update(Product $product): Product;

    /**
     * @param Product $product
     * Delete Product Repository
     *
     * @return mixed
     */
    public function delete(Product $product): bool;

    /**
     * @param ProductImage $productImage
     *
     * @return bool
     */
    public function deleteProductImages(ProductImage $productImage): bool;

    /**
     * @param ProductColor $productColor
     *
     * @return ProductColor
     */
    public function updateProductColors(ProductColor $productColor): ProductColor;

    /**
     * @param ProductColor $productColor
     *
     * @return bool
     */
    public function deleteProductColor(ProductColor $productColor): bool;

}
