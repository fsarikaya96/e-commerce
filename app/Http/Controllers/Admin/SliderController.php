<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;

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

        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $ext      = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $ext;
            $file->move('uploads/slider', $fileName);
            $validatedData['image'] = 'uploads/slider/' . $fileName;
        }

        Slider::create([
            'title'       => $validatedData['title'],
            'description' => $validatedData['title'],
            'image'       => $validatedData['image'],
            'status'      => $request->status ? '1' : '0',
        ]);
        return redirect('admin/sliders')->with('message','Slider Başarıyla Oluşturuldu.');
    }
}
