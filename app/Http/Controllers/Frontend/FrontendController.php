<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
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
        $sliders = $this->sliderService->getSlidersByCondition(['status' => 1])->get();
        $trendingProducts = $this->productService->getProductsByCondition(['trending'=>1])->latest()->take(5)->get();
        $newArrivalProducts = $this->productService->getProductsByCondition([])->latest()->take(5)->get();
        $featuredProducts = $this->productService->getProductsByCondition(['featured' => 1])->latest()->take(5)->get();

        return view('frontend.home', compact('sliders','trendingProducts','newArrivalProducts','featuredProducts'));
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
    public function trendProducts()
    {
        $trendProducts = $this->productService->getProductsByCondition(['trending' => 1])->latest()->take(16)->get();
        return view('frontend.pages.trend-products',compact('trendProducts'));
    }

    public function newArrivals()
    {
        $newArrivalProducts = $this->productService->getProductsByCondition([])->latest()->take(16)->get();
        return view('frontend.pages.new-arrival',compact('newArrivalProducts'));
    }
    public function featuredProducts()
    {
        $featuredProducts = $this->productService->getProductsByCondition(['featured' => 1])->latest()->take(16)->get();
        return view('frontend.pages.featured-products',compact('featuredProducts'));
    }

    public function searchProducts(Request $request)
    {
        if ($request->search)
        {
            $products = Product::where('name','LIKE','%'.$request->search.'%')->Orwhere('brand','LIKE','%'.$request->search.'%')->latest()->paginate(15);

            return view('frontend.pages.search-products',compact('products'));
        }else{
            return redirect()->back()->with('error','Aradığınız Ürün Bulunamadı.');
        }
    }
}
