<?php

namespace App\Repository\Implementations;

use App\Models\Setting;
use App\Repository\Interfaces\ISettingRepository;

class SettingRepository implements ISettingRepository
{
    public function getSetting()
    {
        return Setting::first();
    }

    public function create(Setting $setting):Setting
    {
        $setting->save();

        return $setting;
    }

    public function update(Setting $setting):Setting
    {
        $setting->save();

        return $setting;
    }


}
