<?php

namespace App\Repository\Interfaces;

use App\Models\Setting;

interface ISettingRepository
{
    public function getSetting();

    public function create(Setting $setting);

    public function update(Setting $setting);


}
