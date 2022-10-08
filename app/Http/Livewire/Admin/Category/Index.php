<?php

namespace App\Http\Livewire\Admin\Category;

use App\Services\Interfaces\ICategoryService;
use Flasher\Prime\FlasherInterface;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public $category_id;

    private ICategoryService $categoryService;

    private FlasherInterface $flasher;

    /**
     * Category construct
     *
     * @param ICategoryService $ICategoryService
     * @param FlasherInterface $IFlasherInterface
     */
    public function boot(ICategoryService $ICategoryService,FlasherInterface $IFlasherInterface)
    {
        $this->categoryService = $ICategoryService;
        $this->flasher = $IFlasherInterface;
    }

    public function deleteCategory($category_id)
    {
        $this->category_id = $category_id;
    }

    public function destroyCategory()
    {
        $this->categoryService->delete($this->category_id);
        $this->flasher->addSuccess('Kategori Silindi!');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $categories = $this->categoryService->getCategoriesWithPaginate();

        return view('livewire.admin.category.index', ['categories' => $categories]);
    }

}
