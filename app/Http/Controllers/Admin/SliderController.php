<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
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
        $validatedData = $request->validated();
        $slider = new Slider;
        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $ext      = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $ext;
            $file->move('uploads/sliders', $fileName);
            $slider->image = 'uploads/sliders/' . $fileName;
        }
        $slider->title = $validatedData['title'];
        $slider->description = $validatedData['description'];
        $slider->status = $request->status ? "1" : "0";

        $slider->save();

        return redirect('admin/sliders')->with('message','Slider Başarıyla Oluşturuldu.');
    }

    public function edit(int $slider_id)
    {
       $slider = Slider::findOrFail($slider_id);
       return view('admin.slider.edit',compact('slider'));
    }

    public function update(SliderRequest $request, $slider_id)
    {
        $validatedData = $request->validated();
        $slider = Slider::findOrFail($slider_id);
        if ($request->hasFile('image')) {
            $path = $slider->image;

            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time().'.'.$ext;
            $file->move('uploads/sliders/',$fileName);
            $slider->image = "uploads/sliders/$fileName";

        }
        $slider->title = $validatedData['title'];
        $slider->description = $validatedData['description'];
        $slider->status = $request->status ? "1" : "0";

        $slider->save();

        return redirect('admin/sliders')->with('message','Slider Başarıyla Güncellendi.');

    }
}
