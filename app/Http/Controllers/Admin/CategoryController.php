<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryRequest $request)
    {
        $category      = new Category;
        $validatedData = $request->validated();
        ! $request->filled('slug') ? $category->slug = Str::slug($validatedData['name']) : $category->slug = Str::slug(
            $validatedData['slug']
        );
        if (Category::where('slug', $category->slug)->count() > 0) {
            return back()
                ->withInput()
                ->withErrors(['slug' => 'Slug daha önceden kayıt edilmiş.']);
        }

        $category->name        = $validatedData['name'];
        $category->description = $validatedData['description'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $ext = $file->getClientOriginalExtension();

            $fileName = time() . "." . $ext;
            $file->move('uploads/category/', $fileName);
            $category->image = $fileName;
        }

        $category->meta_title       = $validatedData['meta_title'];
        $category->meta_keyword     = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];

        $category->status = $request->status ? 1 : 0;

        $category->save();

        return redirect('admin/category')->with('message', 'Category Başarıyla Oluşturuldu.');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $category)
    {
        $validatedData         = $request->validated();
        $category              = Category::findOrFail($category);
        $category->slug        = Str::slug($validatedData['slug']);
        $category->name        = $validatedData['name'];
        $category->description = $validatedData['description'];

        if ($request->hasFile('image')) {
            $path = "uploads/category/$category->image";
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');

            $ext = $file->getClientOriginalExtension();

            $fileName = time() . "." . $ext;
            $file->move('uploads/category/', $fileName);
            $category->image = $fileName;
        }

        $category->meta_title       = $validatedData['meta_title'];
        $category->meta_keyword     = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];

        $category->status = $request->status ? 1 : 0;

        $category->save();

        return redirect('admin/category')->with('message', 'Category Başarıyla Güncellendi.');
    }


}
