<?php

namespace App\Repository\Admin\Implementations;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColor;
use App\Repository\Admin\Interfaces\IProductRepository;

class ProductRepository implements IProductRepository
{
    /**
     * Get All Products with Paginate Repository Query
     * @return mixed
     */
    public function getProductWithPaginate(): mixed
    {
        return Product::orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * @param int $id
     * Fetch Product by ID Query
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

    public function createWithColors(Product $product, array $colors): Product
    {
        $product->productColors()->insert($colors);

        return $product;
    }

    public function createWithImages(Product $product, array $productImages): Product
    {
        $product->productImages()->insert($productImages);

        return $product;
    }

    public function updateWithColors(Product $product, array $productColors): Product
    {
        $product->productImages()->create($productColors);

        return $product;
    }

    public function update(Product $product, int $id): object
    {
        $product->save();

        return $product;

    }
}
