<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        !$request->filled('slug') ? $category->slug = Str::slug($validatedData['name']) : $category->slug = Str::slug($validatedData['slug']);
        if (Category::where('slug', $category->slug)->count() > 0) {
            return back()
                ->withInput()
                ->withErrors(['slug' => 'Slug daha önceden kayıt edilmiş.']);
        }

        if ($request->validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($request->validator->errors());
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

        return redirect('admin/category')->with('message', 'Category Oluşturuldu.');
    }
}
