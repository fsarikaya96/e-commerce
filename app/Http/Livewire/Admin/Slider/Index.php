<?php

namespace App\Http\Livewire\Admin\Slider;

use App\Models\Slider;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public $slider_id;

    public function render()
    {
        $slider = Slider::orderBy('id', 'DESC')->paginate(10);

        return view('livewire.admin.slider.index', ['sliders' => $slider]);
    }

    public function deleteSlider($slider_id)
    {
        $this->slider_id = $slider_id;
    }

    public function destroySlider()
    {
        $slider = Slider::findOrFail($this->slider_id);
        $path   = $slider->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        $slider->delete();
        session()->flash("livewire_message","Slider Silindi.");
        $this->dispatchBrowserEvent('close-modal');
    }
}
