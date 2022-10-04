<?php

namespace App\Services\Implementations;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Repository\Implementations\CategoryRepository;
use App\Repository\Implementations\ProductRepository;
use App\Repository\Interfaces\ICategoryRepository;
use App\Repository\Interfaces\IProductRepository;
use App\Services\Interfaces\IProductService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;


class ProductService implements IProductService
{
    private ProductRepository $productRepository;

    private CategoryRepository $categoryRepository;

    /**
     * ProductRepository construct injection
     *
     * @param IProductRepository $IProductRepository
     * @param ICategoryRepository $ICategoryRepository
     */
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
        Log::channel('service')->info("ProductService called --> Request getProductWithPaginate() function");
        try {
            Log::channel('service')->info("ProductService called --> Return all product with paginate");

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
        Log::channel('service')->info("ProductService called --> Request getProductById() function");
        try {
            Log::channel('service')->info("ProductService called --> Return product by ID : " . $id);

            return $this->productRepository->getProductById($id);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Böyle Bir Ürün Bulunamadı.'],
            ]);
        }
    }

    /**
     * @param ProductRequest $request
     *
     * @return Product
     * @throws ValidationException
     */
    public function create(ProductRequest $request): Product
    {
        $category     = $this->categoryRepository->getCategoryById($request->category_id);
        $productModel = new Product();

        $this->extractedItems($request, $productModel);

        $product = $this->productRepository->createWithCategory($category, $productModel);

        $this->extractedImages($request, $product);

        $this->extractedColors($request, $product);
        Log::channel('service')->info("ProductService called --> Request create() function");
        try {
            Log::channel('service')->info("ProductService called --> Insert Product data : " . $product);

            return $product;
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Kayıt işlemi başarısız.'],
            ]);
        }
    }

    /**
     * @param ProductRequest $request
     * @param int $id
     *
     * @return Product
     * @throws ValidationException
     */
    public function update(ProductRequest $request, int $id): Product
    {
        $product = $this->productRepository->getProductById($id);

        $this->extractedItems($request, $product);

        $this->extractedImages($request, $product);

        $this->extractedColors($request, $product);
        Log::channel('service')->info("ProductService called --> Request update() function");
        try {
            Log::channel('service')->info("ProductService called --> Update Product data : " . $product);

            return $this->productRepository->update($product, $id);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Güncelleme işlemi başarısız.'],
            ]);
        }
    }

    /**
     * @param int $id
     *
     * @return bool
     * @throws ValidationException
     */
    public function delete(int $id): bool
    {
        Log::channel('service')->info("ProductService called --> Request delete() function");
        try {
            Log::channel('service')->info("ProductService called --> Delete Product by ID : " . $id);
            $product = $this->productRepository->getProductById($id);
            if ($product->productImages()) {
                foreach ($product->productImages as $image) {
                    if (File::exists($image->image)) {
                        File::delete($image->image);
                    }
                }
            }

            return $this->productRepository->delete($product);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Silme işlemi başarısız.'],
            ]);
        }
    }

    /**
     * @param ProductRequest $request
     * @param $productItem
     *
     * @return void
     */
    public function extractedItems(ProductRequest $request, $productItem): void
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
