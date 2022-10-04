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
        /*
        $validatedData = $request->validated();

        $category = Category::findOrFail($validatedData['category_id']);

        $product = $category->products()->create([
            'category_id'       => $validatedData['category_id'],
            'name'              => $validatedData['name'],
            'slug'              => Str::slug($validatedData['slug']),
            'brand'             => $validatedData['brand'],
            'small_description' => $validatedData['small_description'],
            'description'       => $validatedData['description'],
            'original_price'    => $validatedData['original_price'],
            'selling_price'     => $validatedData['selling_price'],
            'quantity'          => $validatedData['quantity'],
            'trending'          => $request->trending ? "1" : "0",
            'status'            => $request->status ? "1" : "0",
            'meta_title'        => $validatedData['meta_title'],
            'meta_keyword'      => $validatedData['meta_keyword'],
            'meta_description'  => $validatedData['meta_description'],
        ]);

        $this->extracted($request, $product);

        if ($request->colors) {
            foreach ($request->colors as $key => $color) {
                $product->productColors()->create([
                    'product_id' => $product->id,
                    'color_id'   => $color,
                    'quantity'   => $request->color_quantity[$key] ?? 0
                ]);
            }
        }

        return redirect('admin/products')->with('message', 'Ürün Başarıyla Eklendi.');
        */
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
        $image = ProductImage::findOrFail($image_id);

        if (File::exists($image->image)) {
            File::delete($image->image);
            $image->delete();

            return redirect()->back()->with('message', 'Resim Başarıyla Silindi.');
        } else {
            return redirect()->back()->with('error', 'Resim Silinemedi.');
        }
    }

    public function updateProductColor(Request $request, $product_color_id = 0)
    {
        $productColorData = Product::findOrFail($request->product_id)
                                   ->productColors()->where('id', $product_color_id)->first();
        $productColorData->update(['quantity' => $request->qty]);

        return response()->json(['message' => 'Güncelleme Başarılı']);
    }

    public function deleteProductColor($product_color = 0)
    {
        ProductColor::findOrFail($product_color)->delete();

        return response()->json(['message' => 'Silme Başarılı']);
    }


}
