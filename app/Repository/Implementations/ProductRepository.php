<?php

namespace App\Repository\Implementations;

use App\Models\Category;
use App\Models\Product;
use App\Repository\Interfaces\IProductRepository;
use Illuminate\Support\Collection;

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
                      ->when($price, function ($query) use($price) {
                          $query->when($price == 'high-to-low', function ($queryPrice) {
                              $queryPrice->orderBy('selling_price', 'DESC');
                          })->when($price == 'low-to-high',function ($queryPrice){
                              $queryPrice->orderBy('selling_price','ASC');
                          });
                      });
    }
    /**
     * @param array $condition
     *
     * @return mixed
     */
    public function getProductsByCondition(array $condition):mixed{
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
