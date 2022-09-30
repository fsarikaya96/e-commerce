<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use App\Services\Admin\Interfaces\ICategoryService;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    private ICategoryService $categoryService;

    /**
     * Category construct
     * @param ICategoryService $ICategoryService
     * @return ICategoryService
     */
    public function mount(ICategoryService $ICategoryService)
    {
        return $this->categoryService = $ICategoryService;
    }

    public $category_id;

    public function deleteCategory($category_id)
    {
        $this->category_id = $category_id;
    }
    public function destroyCategory()
    {
        $category = Category::find($this->category_id);

        $path = "uploads/category/$category->image";
        if (File::exists($path))
        {
            File::delete($path);
        }
        $category->delete();
        session()->flash("livewire_message","Kategori Silindi.");
        $this->dispatchBrowserEvent('close-modal');
    }
    public function render()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('livewire.admin.category.index',['categories' => $categories]);
    }

}
