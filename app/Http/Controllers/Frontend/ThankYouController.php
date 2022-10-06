<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;

class ThankYouController extends Controller
{
    public function index()
    {
        $userOrders = OrderItem::with('orders','products')->whereHas('orders',function ($query){
            $query->where('user_id',auth()->user()->id);
        })->get();
        return view('frontend.thankyou.index',compact('userOrders'));
    }
}
