<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Services\Interfaces\ISliderService;

class SliderController extends Controller
{
    private ISliderService $sliderService;

    public function __construct(ISliderService $ISliderService)
    {
        $this->sliderService = $ISliderService;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.slider.index');
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(SliderRequest $request)
    {
        $this->sliderService->create($request);
        return redirect('admin/sliders')->with('success', 'Slider Başarıyla Oluşturuldu.');
    }

    public function edit(int $slider_id)
    {
        $slider = $this->sliderService->getSliderById($slider_id);

        return view('admin.slider.edit', compact('slider'));
    }

    public function update(SliderRequest $request, int $id)
    {
        $this->sliderService->update($request,$id);

        return redirect('admin/sliders')->with('success', 'Slider Başarıyla Güncellendi.');
    }
}
