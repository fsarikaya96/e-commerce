<?php

namespace App\Repository\Implementations;

use App\Models\Category;
use App\Models\Product;
use App\Repository\Interfaces\IProductRepository;

class ProductRepository implements IProductRepository
{
    /**
     * Get All Products with Paginate Repository
     * @return mixed
     */
    public function getProductWithPaginate(): mixed
    {
        return Product::orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * @param int $id
     * Fetch Product by ID Repository
     *
     * @return Product
     */
    public function getProductById(int $id): Product
    {
        return Product::findOrFail($id);
    }

    /**
     * @param Category $category
     * @param Product $product
     * Insert Product Repository
     *
     * @return Product
     */
    public function createWithCategory(Category $category, Product $product): Product
    {
        $category->products()->save($product);

        return $product;
    }

    /**
     * @param Product $product
     * @param array $colors
     * Create with Colors Repository
     *
     * @return Product
     */
    public function createWithColors(Product $product, array $colors): Product
    {
        $product->productColors()->insert($colors);

        return $product;
    }

    /**
     * @param Product $product
     * @param array $productImages
     * Create with Images Repository
     *
     * @return Product
     */
    public function createWithImages(Product $product, array $productImages): Product
    {
        $product->productImages()->insert($productImages);

        return $product;
    }

    /**
     * @param Product $product
     * @param array $productColors
     * Update with Colors Repository
     *
     * @return Product
     */
    public function updateWithColors(Product $product, array $productColors): Product
    {
        $product->productImages()->create($productColors);

        return $product;
    }

    /**
     * @param Product $product
     * @param int $id
     * Update Product Repository
     *
     * @return Product
     */
    public function update(Product $product, int $id)
    {
        $product->save();

        return $product;
    }

    /**
     * @param Product $product
     * Delete Product Repository
     *
     * @return bool
     */
    public function delete(Product $product): bool
    {
        return $product->delete();
    }
}
