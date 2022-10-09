<?php

namespace App\Services\Interfaces;

use App\Models\Setting;
use Illuminate\Http\Request;

interface ISettingService
{
    public function getSetting();

    public function createOrUpdate(Request $request):Setting;
}
