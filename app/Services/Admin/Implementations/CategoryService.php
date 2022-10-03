<?php

namespace App\Services\Admin\Implementations;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repository\Admin\Interfaces\ICategoryRepository;
use App\Services\Admin\Interfaces\ICategoryService;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
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

    /**
     * @return mixed
     * @throws Exception
     */
    public function getCategoriesWithPaginate(): mixed
    {
        Log::channel('service')->info("CategoryService called --> Request getCategoriesWithPaginate() function");
        try {
            Log::channel('service')->info("CategoryService called --> Return all categories with paginate");

            return $this->categoryRepository->getCategoriesWithPaginate();
        } catch (Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Kategori Bulunamadı.'],
            ]);
        }
    }

    /**
     * @param array $condition
     *
     * @return Collection
     * @throws ValidationException
     */
    public function getCategoriesByCondition(array $condition): Collection
    {
        Log::channel('service')->info("CategoryService called --> Request getCategoriesByCondition() function");
        try {
            Log::channel('service')->info("CategoryService called --> Return all categories by condition");

            return $this->categoryRepository->getCategoriesByCondition($condition);
        } catch (Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Kategori Bulunamadı.'],
            ]);
        }
    }

    /**
     * @param CategoryRequest $request
     *
     * @return Category
     * @throws ValidationException
     */
    public function create(CategoryRequest $request): Category
    {
        $category      = new Category;
        $validatedData = $request->validated();
        ! $request->filled('slug') ? $category->slug = Str::slug($validatedData['name'])
            : $category->slug = Str::slug($validatedData['slug']);

        if (Category::where('slug', $category->slug)->count() > 0) {
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
        Log::channel('service')->info("CategoryService called --> Request create() function");

        try {
            Log::channel('service')->info("CategoryService called --> Insert category " . $category);

            return $this->categoryRepository->create($category);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Kayıt işlemi başarısız.'],
            ]);
        }
    }


    /**
     * @param int $id
     *
     * @return Category
     * @throws ValidationException
     */
    public function getCategoryById(int $id): Category
    {
        Log::channel('service')->info("CategoryService called --> Request edit() function");
        try {
            Log::channel('service')->info('CategoryService Called ---> Return get category by id : ' . $id);

            return $this->categoryRepository->getCategoryById($id);
        } catch (Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Böyle Bir Kategori Bulunamadı.'],
            ]);
        }
    }

    /**
     * @param CategoryRequest $request
     * @param int $id
     *
     * @return Category
     * @throws ValidationException
     */
    public function update(CategoryRequest $request, int $id): Category
    {
        $validatedData         = $request->validated();
        $category              = $this->categoryRepository->getCategoryById($id);
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

        Log::channel('service')->info("CategoryService called --> Request update() function");
        try {
            Log::channel('service')->info("CategoryService called --> Update category " . $category);

            return $this->categoryRepository->update($category, $id);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Güncelleme işlemi başarısız..'],
            ]);
        }
    }

    /**
     * @param int $id
     *
     * @return mixed
     * @throws ValidationException
     */
    public function delete(int $id): bool
    {
        Log::channel('service')->info("CategoryService called --> Request delete() function");
        try {
            Log::channel('service')->info("CategoryService called --> Delete category by id :" . $id);
            $category = $this->categoryRepository->getCategoryById($id);
        } catch (Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Silme işlemi başarısız.'],
            ]);
        }

        $path = $category->image;
        if (File::exists($path)) {
            File::delete($path);
        }

        return $this->categoryRepository->delete($category);
    }
}
