<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product.index');
    }

    public function create()
    {
        $categories = Category::all();
        $brands     = Brand::all();

        return view('admin.product.create', compact('categories', 'brands'));
    }

    public function store(ProductRequest $request)
    {
        $validatedData = $request->validated();

        $category = Category::findOrFail($validatedData['category_id']);

        $product = $category->products()->create([
            'category_id'       => $validatedData['category_id'],
            'name'              => $validatedData['name'],
            'slug'              => Str::slug($validatedData['slug']),
            'brand_id'          => $validatedData['brand_id'],
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

        return redirect('admin/products')->with('message', 'Ürün Başarıyla Eklendi.');
    }
    public function edit(int $product_id)
    {
        $product = Product::with('category')->findOrFail($product_id);
        $categories = Category::all();
        $brands     = Brand::all();
        return view('admin.product.edit',compact('product','categories','brands'));
    }
    public function update(ProductRequest $request, int $product_id)
    {
        $validatedData = $request->validated();
        $product = Category::findOrFail($validatedData['category_id'])
                              ->products()->where('id',$product_id)->first();

        if ($product)
        {
            $product->update([
                'category_id'       => $validatedData['category_id'],
                'name'              => $validatedData['name'],
                'slug'              => Str::slug($validatedData['slug']),
                'brand_id'          => $validatedData['brand_id'],
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

            return redirect('admin/products')->with('message', 'Ürün Başarıyla Güncellendi.');
        }else {
            return redirect('admin/products')->with('error', 'Böyle Bir Ürün Kimliği Yok.');
        }


    }
    public function deleteImage(int $image_id)
    {
        $image = ProductImage::findOrFail($image_id);

        if (File::exists($image->image))
        {
            File::delete($image->image);
            $image->delete();
            return redirect()->back()->with('message', 'Resim Başarıyla Silindi.');
        }else {
            return redirect()->back()->with('error', 'Resim Silinemedi.');
        }
    }

    /**
     * @param ProductRequest $request
     * @param $product
     *
     * @return void
     */
    public function extracted(ProductRequest $request, $product): void
    {
        if ($request->hasFile('image')) {
            $uploadPath = "uploads/products/";
            $i          = 1;
            foreach ($request->file('image') as $imageFile) {
                $extension = $imageFile->getClientOriginalExtension();
                $fileName  = time() . $i++ . '.' . $extension;
                $imageFile->move($uploadPath, $fileName);
                $imagePathName = $uploadPath . $fileName;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image'      => $imagePathName
                ]);
            }
        }
    }
}
