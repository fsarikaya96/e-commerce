<?php

namespace App\Http\Livewire\Admin\Slider;

use App\Services\Interfaces\ISliderService;
use Flasher\Prime\FlasherInterface;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public $slider_id;

    private ISliderService $sliderService;
    private FlasherInterface $flasher;

    public function boot(ISliderService $ISliderService, FlasherInterface $IFlasherInterface)
    {
        $this->sliderService = $ISliderService;
        $this->flasher = $IFlasherInterface;
    }

    public function deleteSlider($slider_id)
    {
        $this->slider_id = $slider_id;
    }

    public function destroySlider()
    {
        $this->sliderService->delete($this->slider_id);
        $this->flasher->addSuccess('Slider Silindi!');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $sliders = $this->sliderService->getSlidersWithPaginate();

        return view('livewire.admin.slider.index', ['sliders' => $sliders]);
    }
}
