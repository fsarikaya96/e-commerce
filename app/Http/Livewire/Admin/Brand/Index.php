<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use App\Services\Admin\Interfaces\IBrandService;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public $name, $slug, $status, $category_id, $brandID;

    private IBrandService $brandService;

    /**
     * Brand construct
     *
     * @param IBrandService $IBrandService
     */
    public function boot(IBrandService $IBrandService)
    {
        $this->brandService = $IBrandService;
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

        session()->flash('livewire_message', 'Marka Başarıyla Eklendi');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetForm();
    }

    public function closeModal()
    {
        $this->resetForm();
    }

    public function openModal()
    {
        $this->resetForm();
    }

    public function editBrand(int $brandID)
    {
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

        session()->flash('livewire_message', 'Marka Başarıyla Güncellendi');
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
        session()->flash('livewire_message', 'Marka Başarıyla Silindi');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetForm();
    }

    public function render()
    {
        $brands     = $this->brandService->getAllBrands();
        $categories = $this->brandService->getAllCategories();

        return view('livewire.admin.brand.index', ['brands' => $brands, 'categories' => $categories]);
    }
}
