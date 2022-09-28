<?php

namespace App\Http\Livewire\Admin\Slider;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public function render()
    {
        $slider = Slider::orderBy('id','DESC')->paginate(1);
        return view('livewire.admin.slider.index',['sliders' => $slider]);
    }
}
