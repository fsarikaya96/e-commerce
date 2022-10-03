<?php

namespace App\Repository\Admin\Interfaces;

use App\Models\Category;
use App\Models\Product;


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
     *
     * @return Product
     */
    public function createWithColors(Product $product , array $colors): Product;

    /**
     * @param Product $product
     * @param array $productImages
     *
     * @return Product
     */
    public function createWithImages(Product $product, array $productImages):Product;

    /**
     * @param Product $product
     * @param array $productColors
     *
     * @return Product
     */

    public function updateWithColors(Product $product, array $productColors):Product;

    /**
     * @param Product $product
     * @param int $id
     * Update Product Repository
     * @return Product
     */
    public function update(Product $product, int $id):object;

}
