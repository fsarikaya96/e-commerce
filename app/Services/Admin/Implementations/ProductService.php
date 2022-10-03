<?php

namespace App\Services\Admin\Implementations;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColor;
use App\Repository\Admin\Implementations\CategoryRepository;
use App\Repository\Admin\Implementations\ProductRepository;
use App\Repository\Admin\Interfaces\ICategoryRepository;
use App\Repository\Admin\Interfaces\IProductRepository;
use App\Services\Admin\Interfaces\IProductService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;


class ProductService implements IProductService
{
    private ProductRepository $productRepository;

    private CategoryRepository $categoryRepository;

    public function __construct(IProductRepository $IProductRepository, ICategoryRepository $ICategoryRepository)
    {
        $this->productRepository  = $IProductRepository;
        $this->categoryRepository = $ICategoryRepository;
    }

    /**
     * @return mixed
     * @throws ValidationException
     */
    public function getProductWithPaginate(): mixed
    {
        Log::channel('service')->info("BrandService called --> Request getProductWithPaginate() function");
        try {
            Log::channel('service')->info("BrandService called --> Return all product with paginate");

            return $this->productRepository->getProductWithPaginate();
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Böyle Bir Ürün Bulunamadı.'],
            ]);
        }
    }

    /**
     * @param int $id
     *
     * @return Product
     * @throws ValidationException
     */
    public function getProductById(int $id): Product
    {
        Log::channel('service')->info("BrandService called --> Request getProductById() function");
        try {
            Log::channel('service')->info("BrandService called --> Return product by ID : " . $id);

            return $this->productRepository->getProductById($id);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Böyle Bir Ürün Bulunamadı.'],
            ]);
        }
    }

    public function create(ProductRequest $request): Product
    {
        $category      = $this->categoryRepository->getCategoryById($request->category_id);
        $productModel  = new Product();

        $this->extractedItems($request, $productModel);

        $product = $this->productRepository->createWithCategory($category, $productModel);

        $this->extractedImages($request, $product);

        $this->extractedColors($request, $product);

        return $product;
    }

    public function update(ProductRequest $request, int $id): Product
    {
        $product = $this->productRepository->getProductById($id);
        $this->extractedItems($request, $product);

        $this->extractedImages($request, $product);

        $this->extractedColors($request, $product);

        return $this->productRepository->update($product, $id);
    }

    public function extractedItems(ProductRequest $request, $productItem)
    {
        $validatedData                  = $request->validated();
        $productItem->category_id       = $validatedData['category_id'];
        $productItem->name              = $validatedData['name'];
        $productItem->slug              = Str::slug($validatedData['slug']);
        $productItem->brand             = $validatedData['brand'];
        $productItem->small_description = $validatedData['small_description'];
        $productItem->description       = $validatedData['description'];
        $productItem->selling_price     = $validatedData['selling_price'];
        $productItem->original_price    = $validatedData['original_price'];
        $productItem->quantity          = $validatedData['quantity'];
        $productItem->trending          = $request->trending ? "1" : "0";
        $productItem->status            = $request->status ? "1" : "0";
        $productItem->meta_title        = $validatedData['meta_title'];
        $productItem->meta_keyword      = $validatedData['meta_keyword'];
        $productItem->meta_description  = $validatedData['meta_description'];
    }

    /**
     * @param ProductRequest $request
     * @param $product
     *
     * @return Product
     */
    public function extractedColors(ProductRequest $request, $product): Product
    {
        $productColors = [];
        if ($request->colors) {
            foreach ($request->colors as $key => $color) {
                $productColors [] = [
                    'product_id' => $product->id,
                    'color_id'   => $color,
                    'quantity'   => $request->color_quantity[$key] ?? 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        return $this->productRepository->createWithColors($product, $productColors);
    }

    /**
     * @param ProductRequest $request
     * @param $product
     *
     * @return Product
     */

    public function extractedImages(ProductRequest $request, $product): Product
    {
        $productImages = [];
        if ($request->hasFile('image')) {
            $uploadPath = "uploads/products/";
            $i          = 1;
            foreach ($request->file('image') as $imageFile) {
                $extension = $imageFile->getClientOriginalExtension();
                $fileName  = time() . $i++ . '.' . $extension;
                $imageFile->move($uploadPath, $fileName);
                $imagePathName = $uploadPath . $fileName;

                $productImages[] = [
                    'product_id' => $product->id,
                    'image'      => $imagePathName,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        return $this->productRepository->createWithImages($product, $productImages);
    }

}
