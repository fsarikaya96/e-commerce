<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public $name, $slug, $status, $category_id, $brandID;

    public function rules()
    {
        return [
            'name'        => 'required|string',
            'slug'        => 'required|string|unique:brands,slug,' . $this->brandID,
            'status'      => 'nullable',
            'category_id' => 'required|integer'
        ];
    }

    public function resetForm()
    {
        $this->name        = null;
        $this->slug        = null;
        $this->status      = null;
        $this->category_id = null;
        $this->brandID     = null;
    }

    public function storeBrand()
    {
        $this->validate();
        Brand::create([
            'name'        => $this->name,
            'slug'        => Str::slug($this->slug),
            'status'      => $this->status ? "1" : "0",
            'category_id' => $this->category_id
        ]);
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
        $brand             = Brand::findOrFail($brandID);
        $this->name        = $brand->name;
        $this->slug        = $brand->slug;
        $this->status      = $brand->status;
        $this->category_id = $brand->category_id;
    }

    public function updateBrand()
    {
        $this->validate();
        Brand::findOrFail($this->brandID)->update([
            'name'        => $this->name,
            'slug'        => Str::slug($this->slug),
            'status'      => $this->status ? "1" : "0",
            'category_id' => $this->category_id
        ]);
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
        Brand::findOrFail($this->brandID)->delete();
        session()->flash('livewire_message', 'Marka Başarıyla Silindi');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetForm();
    }

    public function render()
    {
        $brands     = Brand::orderBy('id', 'DESC')->paginate(10);
        $categories = Category::where('status', 1)->get();

        return view('livewire.admin.brand.index', ['brands' => $brands, 'categories' => $categories])
            ->extends('layouts.admin')
            ->section('content');
    }
}
