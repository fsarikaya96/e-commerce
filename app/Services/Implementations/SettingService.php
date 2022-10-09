<?php

namespace App\Services\Implementations;

use App\Models\Setting;
use App\Repository\Interfaces\ISettingRepository;
use App\Services\Interfaces\ISettingService;
use Illuminate\Http\Request;

class SettingService implements ISettingService
{
    private ISettingRepository $settingRepository;

    public function __construct(ISettingRepository $ISettingRepository)
    {
        $this->settingRepository = $ISettingRepository;
    }

    public function getSetting()
    {
        return $this->settingRepository->getSetting();
    }

    public function createOrUpdate(Request $request): Setting
    {
        $setting = $this->settingRepository->getSetting();

        if ($setting) {
            // Update
            $this->extracted($request, $setting);
            $this->settingRepository->update($setting);

            return $setting;
        } else {
            // Create
            $settingModel = new Setting();
            $this->extracted($request, $settingModel);
            $this->settingRepository->create($settingModel);

            return $settingModel;
        }
    }

    /**
     * @param Request $request
     * @param $setting
     *
     * @return void
     */
    public function extracted(Request $request, $setting): void
    {
        $setting->website_name     = $request->website_name;
        $setting->website_url      = $request->website_url;
        $setting->website_title    = $request->website_title;
        $setting->meta_keyword     = $request->meta_keyword;
        $setting->meta_description = $request->meta_description;
        $setting->address          = $request->address;
        $setting->phone1           = $request->phone1;
        $setting->phone2           = $request->phone2;
        $setting->email1           = $request->email1;
        $setting->email2           = $request->email2;
        $setting->facebook         = $request->facebook;
        $setting->twitter          = $request->twitter;
        $setting->instagram        = $request->instagram;
        $setting->youtube          = $request->youtube;
    }
}
