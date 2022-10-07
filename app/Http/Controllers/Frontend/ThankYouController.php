<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class ThankYouController extends Controller
{
    public function index()
    {
        return view('frontend.thankyou.index');
    }
}
