<?php

namespace App\Services\Admin\Implementations;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repository\Admin\Interfaces\ICategoryRepository;
use App\Services\Admin\Interfaces\ICategoryService;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CategoryService implements ICategoryService
{
    private ICategoryRepository $categoryRepository;

    /**
     * CategoryRepository constructor injection
     *
     * @param ICategoryRepository $ICategoryRepository
     */
    public function __construct(ICategoryRepository $ICategoryRepository)
    {
        $this->categoryRepository = $ICategoryRepository;
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->getAllCategories();
    }


    /**
     * @throws ValidationException
     */
    public function create(CategoryRequest $request): Category
    {
        $category      = new Category;
        $validatedData = $request->validated();
        ! $request->filled('slug') ? $category->slug = Str::slug($validatedData['name'])
          : $category->slug = Str::slug($validatedData['slug']);

            if(Category::where('slug', $category->slug)->count() > 0){
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'slug' => ['Slug daha önceden kayıt edilmiş.'],
                ]);
            }


        $category->name        = $validatedData['name'];
        $category->description = $validatedData['description'];
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $ext = $file->getClientOriginalExtension();

            $fileName = time() . "." . $ext;
            $file->move('uploads/category/', $fileName);
            $category->image = "uploads/category/$fileName";
        }

        $category->meta_title       = $validatedData['meta_title'];
        $category->meta_keyword     = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];

        $category->status = $request->status ? 1 : 0;

        return $this->categoryRepository->create($category);
    }
    public function update(CategoryRequest $request, $category_id): Category
    {
        $validatedData         = $request->validated();
        $category              = Category::findOrFail($category_id);
        $category->slug        = Str::slug($validatedData['slug']);
        $category->name        = $validatedData['name'];
        $category->description = $validatedData['description'];

        if ($request->hasFile('image')) {
            $path = $category->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');

            $ext = $file->getClientOriginalExtension();

            $fileName = time() . "." . $ext;
            $file->move('uploads/category/', $fileName);
            $category->image = "uploads/category/$fileName";
        }

        $category->meta_title       = $validatedData['meta_title'];
        $category->meta_keyword     = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];

        $category->status = $request->status ? 1 : 0;

        return $this->categoryRepository->update($category,$category_id);
    }
    public function delete($category_id)
    {
        $category = Category::findOrFail($category_id);

        $path = "uploads/category/$category->image";
        if (File::exists($path))
        {
            File::delete($path);
        }
       return $this->categoryRepository->delete($category_id);

    }
}
