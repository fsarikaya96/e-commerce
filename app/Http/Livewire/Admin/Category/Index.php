<?php

namespace App\Http\Livewire\Admin\Category;

use App\Services\Admin\Interfaces\ICategoryService;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public $category_id;

    private ICategoryService $categoryService;

    /**
     * Category construct
     *
     * @param ICategoryService $ICategoryService
     */
    public function boot(ICategoryService $ICategoryService)
    {
        $this->categoryService = $ICategoryService;
    }

    public function deleteCategory($category_id)
    {
        $this->category_id = $category_id;
    }

    public function destroyCategory()
    {
        $this->categoryService->delete($this->category_id);

        session()->flash("livewire_message", "Kategori Silindi.");
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $categories = $this->categoryService->getCategoriesWithPaginate();

        return view('livewire.admin.category.index', ['categories' => $categories]);
    }

}
