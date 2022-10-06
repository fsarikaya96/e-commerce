<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Services\Interfaces\ICategoryService;
use App\Services\Interfaces\IProductService;
use App\Services\Interfaces\ISliderService;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    private ISliderService $sliderService;
    private ICategoryService $categoryService;
    private IProductService $productService;

    public function __construct(
        ISliderService $ISliderService,
        ICategoryService $ICategoryService,
        IProductService $IProductService
    ) {
        $this->sliderService = $ISliderService;
        $this->categoryService = $ICategoryService;
        $this->productService = $IProductService;
    }

    public function index()
    {
        $sliders = $this->sliderService->getSlidersByCondition(['status' => 1]);

        return view('frontend.home', compact('sliders'));
    }

    public function categories()
    {
        $categories = $this->categoryService->getCategoriesByCondition(['status' => 1]);

        return view('frontend.collections.category.index', compact('categories'));
    }

    public function products($category_slug)
    {
        $category = $this->categoryService->getCategoriesByCondition(['slug' => $category_slug])->first();
        if ($category) {
            return view('frontend.collections.products.index', compact('category'));
        } else {
            return redirect()->back();
        }
    }

    public function productView(string $category_slug, string $product_slug)
    {
        $category = $this->categoryService->getCategoriesByCondition(['slug' => $category_slug])->first();
        if ($category) {
            $product = $this->productService->getProductsByCondition(['slug' => $product_slug, 'status' => 1])->first();

            return view('frontend.collections.products.view', compact('category', 'product'));
        }

        return view('frontend.collections.products.view');
    }
}
