<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use App\Services\Interfaces\IBrandService;
use App\Services\Interfaces\ICategoryService;
use Flasher\Prime\FlasherInterface;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public $name, $slug, $status, $category_id, $brandID;

    private IBrandService $brandService;
    private ICategoryService $categoryService;
    private FlasherInterface $flasher;

    /**
     * Brand construct
     *
     * @param IBrandService $IBrandService
     * @param ICategoryService $ICategoryService
     * @param FlasherInterface $IFlasherInterface
     */
    public function boot(IBrandService $IBrandService, ICategoryService $ICategoryService, FlasherInterface $IFlasherInterface)
    {
        $this->categoryService = $ICategoryService;
        $this->brandService    = $IBrandService;
        $this->flasher = $IFlasherInterface;
    }

    public function rules()
    {
        return Brand::rules($this->brandID);
    }

    public function resetForm()
    {
        $this->name        = null;
        $this->slug        = null;
        $this->status      = null;
        $this->category_id = null;
        $this->brandID     = null;
    }

    public function storeBrand(Brand $brand)
    {
        $validatedData = $this->validate();
        $data          = $brand->fill($validatedData);
        $this->brandService->create($data);

        $this->flasher->addSuccess('Marka Başarıyla Eklendi!');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetForm();
    }

    public function closeModal()
    {
        $this->resetValidation();
        $this->resetForm();
    }

    public function openModal()
    {
        $this->resetValidation();
        $this->resetForm();
    }

    public function editBrand(int $brandID)
    {
        $this->resetValidation();
        $this->brandID     = $brandID;
        $brand             = $this->brandService->getBrandById($brandID);
        $this->name        = $brand->name;
        $this->slug        = $brand->slug;
        $this->status      = $brand->status;
        $this->category_id = $brand->category_id;
    }

    public function updateBrand()
    {
        $validatedData = $this->validate();
        $brand         = $this->brandService->getBrandById($this->brandID);
        $data          = $brand->fill($validatedData);
        $this->brandService->update($data, $this->brandID);
        $this->flasher->addSuccess('Marka Başarıyla Güncellendi!');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetForm();
    }

    public function deleteBrand($brandID)
    {
        $this->brandID = $brandID;
    }

    public function destroyBrand()
    {
        $this->brandService->delete($this->brandID);
        $this->flasher->addSuccess('Marka Başarıyla Silindi!');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetForm();
    }

    public function render()
    {
        $brands     = $this->brandService->getBrandsWithPaginate();
        $categories = $this->categoryService->getCategoriesByCondition([]);

        return view('livewire.admin.brand.index', ['brands' => $brands, 'categories' => $categories]);
    }
}
