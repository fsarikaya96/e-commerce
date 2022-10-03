<?php

namespace App\Http\Livewire\Admin\Slider;

use App\Models\Slider;
use App\Services\Admin\Interfaces\ISliderService;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public $slider_id;

    private ISliderService $sliderService;

    public function boot(ISliderService $ISliderService)
    {
        $this->sliderService = $ISliderService;
    }

    public function deleteSlider($slider_id)
    {
        $this->slider_id = $slider_id;
    }

    public function destroySlider()
    {
        $this->sliderService->delete($this->slider_id);
        session()->flash("livewire_message", "Slider Silindi.");
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $sliders = $this->sliderService->getSlidersWithPaginate();

        return view('livewire.admin.slider.index', ['sliders' => $sliders]);
    }
}
