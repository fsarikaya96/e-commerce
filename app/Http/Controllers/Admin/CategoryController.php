<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\Admin\Interfaces\ICategoryService;

class CategoryController extends Controller
{
    private ICategoryService $categoryService;

    /**
     * Category construct
     *
     * @param ICategoryService $ICategoryService
     */
    public function __construct(ICategoryService $ICategoryService)
    {
        $this->middleware('auth');
        return $this->categoryService = $ICategoryService;
    }

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
        $this->categoryService->create($request);

        return redirect('admin/category')->with('message', 'Kategori Başarıyla Oluşturuldu.');
    }

    public function edit(int $id)
    {
        $category = $this->categoryService->getCategoryById($id);

        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, int $id)
    {
        $this->categoryService->update($request, $id);

        return redirect('admin/category')->with('message', 'Kategori Başarıyla Güncellendi.');
    }


}
