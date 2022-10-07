<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Services\Interfaces\IBrandService;
use App\Services\Interfaces\ICategoryService;
use App\Services\Interfaces\IColorService;
use App\Services\Interfaces\IProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    private IProductService $productService;
    private ICategoryService $categoryService;
    private IBrandService $brandService;
    private IColorService $colorService;

    public function __construct(
        IProductService $IProductService,
        ICategoryService $ICategoryService,
        IBrandService $IBrandService,
        IColorService $IColorService
    ) {
        $this->productService  = $IProductService;
        $this->categoryService = $ICategoryService;
        $this->brandService    = $IBrandService;
        $this->colorService    = $IColorService;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.product.index');
    }

    public function create()
    {
        $categories = $this->categoryService->getCategoriesByCondition(['status' => 1]);
        $brands     = $this->brandService->getBrandsByCondition(['status' => 1]);
        $colors     = $this->colorService->getColorsByCondition(['status' => 1]);

        return view('admin.product.create', compact('categories', 'brands', 'colors'));
    }

    public function store(ProductRequest $request)
    {
        $this->productService->create($request);

        return redirect('admin/products')->with('message', 'Ürün Başarıyla Eklendi.');
    }

    public function edit(int $product_id)
    {
        $product      = $this->productService->getProductById($product_id);
        $categories   = $this->categoryService->getCategoriesByCondition(['status' => 1]);
        $brands       = $this->brandService->getBrandsByCondition(['status' => 1]);
        $productColor = $product->productColors->pluck('color_id')->toArray();

        $colors = $this->colorService->getColorByProductID($productColor);

        return view('admin.product.edit', compact('product', 'categories', 'brands', 'colors', 'productColor'));
    }

    public function update(ProductRequest $request, int $id)
    {
        $this->productService->update($request, $id);

        return redirect('admin/products')->with('message', 'Ürün Başarıyla Güncellendi.');
    }

    public function deleteImage(int $image_id)
    {
        $this->productService->deleteProductImages($image_id);

        return redirect('admin/products')->with('message', 'Resim Başarıyla Silinmiştir.');
    }

    public function updateProductColor(Request $request, $product_color_id = 0)
    {
        $this->productService->updateProductColors($request,$product_color_id);

        return response()->json(['message' => 'Güncelleme Başarılı']);
    }

    public function deleteProductColor($product_color = 0)
    {
        $this->productService->deleteProductColor($product_color);

        return response()->json(['message' => 'Silme Başarılı']);
    }

}
