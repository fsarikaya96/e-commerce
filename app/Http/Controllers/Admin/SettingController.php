<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\ISettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private ISettingService $settingService;

    public function __construct(ISettingService $ISettingService)
    {
        $this->settingService = $ISettingService;
    }

    public function index()
    {
        $setting = $this->settingService->getSetting();
        return view('admin.setting.index',compact('setting'));
    }

    public function store(Request $request)
    {
        $this->settingService->createOrUpdate($request);

        return redirect()->back()->with('success','Başarıyla Kaydedildi');
    }
}
