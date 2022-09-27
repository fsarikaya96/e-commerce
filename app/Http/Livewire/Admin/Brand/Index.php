<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public $name, $slug, $status;

    public function rules()
    {
        return [
            'name'   => 'required|string',
            'slug'   => 'required|string|unique:brands,slug',
            'status' => 'nullable'
        ];
    }
    public function resetForm()
    {
        $this->name = null;
        $this->slug = null;
        $this->status = null;
    }
    public function storeBrand()
    {
        $this->validate();
        Brand::create([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status ? "1" : "0",
        ]);
        session()->flash('message','Marka Başarıyla Eklendi');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetForm();

    }

    public function render()
    {
        $brands = Brand::orderBy('id','DESC')->paginate(10);
        return view('livewire.admin.brand.index',['brands' => $brands])
            ->extends('layouts.admin')
            ->section('content');
    }
}
