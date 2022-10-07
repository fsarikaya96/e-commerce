<?php

namespace App\Repository\Implementations;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Repository\Interfaces\IProductRepository;

class ProductRepository implements IProductRepository
{
    /**
     * Get All Products with Paginate Repository
     * @return mixed
     */
    public function getProductsWithPaginate(): mixed
    {
        return Product::orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * Fetch Products by Filter Repository
     *
     * @param array $condition
     * @param array $brand
     * @param string|null $price
     *
     * @return mixed
     */

    public function getProductsByFilter(array $condition, array $brand, ?string $price): mixed
    {
        return Product::where($condition)
                      ->when($brand, function ($query) use ($brand) {
                          $query->whereIn('brand', $brand);
                      })
                      ->when($price, function ($query) use ($price) {
                          $query->when($price == 'high-to-low', function ($queryPrice) {
                              $queryPrice->orderBy('selling_price', 'DESC');
                          })->when($price == 'low-to-high', function ($queryPrice) {
                              $queryPrice->orderBy('selling_price', 'ASC');
                          });
                      });
    }

    /**
     * @param array $condition
     * Fetch Product by Condition Repository
     *
     * @return mixed
     */
    public function getProductsByCondition(array $condition): mixed
    {
        return Product::where($condition);
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
     * @param int $id
     * Fetch Product Image by Repository
     *
     * @return ProductImage
     */
    public function getProductImageById(int $id): ProductImage
    {
        return ProductImage::findOrFail($id);
    }

    /**
     * @param int $id
     * Fetch Product Color by ID Repository
     *
     * @return ProductColor
     */
    public function getProductColorById(int $id): ProductColor
    {
        return ProductColor::findOrFail($id);
    }

    /**
     * Fetch Product Color by Condition Repository
     *
     * @param int $productID
     * @param int $productColorID
     *
     * @return ProductColor
     */
    public function getProductColorByCondition(int $productID, int $productColorID): ProductColor
    {
        return Product::findOrFail($productID)->productColors()->where('id', $productColorID)->first();
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
     * Update Product Repository
     *
     * @return Product
     */
    public function update(Product $product): Product
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

    /**
     * @param ProductImage $productImage
     * Delete Product Images Repository
     * @return bool
     */
    public function deleteProductImages(ProductImage $productImage): bool
    {
        return $productImage->delete();
    }

    /**
     * @param ProductColor $productColor
     * Update Product Colors Repository
     * @return ProductColor
     */
    public function updateProductColors(ProductColor $productColor): ProductColor
    {
        $productColor->save();

        return $productColor;
    }

    /**
     * @param ProductColor $productColor
     * Delete Product Color Repository
     * @return bool
     */
    public function deleteProductColor(ProductColor $productColor): bool
    {
        return $productColor->delete();
    }
}
