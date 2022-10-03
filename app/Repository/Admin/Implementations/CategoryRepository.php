<?php

namespace App\Repository\Admin\Implementations;

use App\Models\Category;
use App\Repository\Admin\Interfaces\ICategoryRepository;
use Illuminate\Support\Collection;

class CategoryRepository implements ICategoryRepository
{
    /**
     * Get All Categories with Paginate Repository
     * @return mixed
     */

    public function getCategoriesWithPaginate(): mixed
    {
        return Category::orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * Fetch Categories by Condition
     *
     * @param array $condition
     *
     * @return Collection
     */
    public function getCategoriesByCondition(array $condition): Collection
    {
        return Category::where($condition)->get();
    }

    /**
     * @param Category $category
     * Insert Category
     *
     * @return Category
     */

    public function create(Category $category): Category
    {
        $category->save();

        return $category;
    }

    /**
     * @param int $id
     * Fetch category by id
     * @return Category
     */
    public function getCategoryById(int $id): Category
    {
        return Category::findOrFail($id);
    }

    /**
     * @param Category $category
     * Update Category
     * @param $id
     *
     * @return Category
     */

    public function update(Category $category, $id): Category
    {
        $category->save();

        return $category;
    }

    /**
     * @param $category
     * Delete Category
     *
     * @return mixed
     */
    public function delete(Category $category): bool
    {
        return $category->delete();
    }
}
