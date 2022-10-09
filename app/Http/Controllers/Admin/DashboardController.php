<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalProducts   = Product::count();
        $totalCategories = Category::count();
        $totalBrands     = Brand::count();
        $totalUsers      = User::count();


        $monthDate = Carbon::now()->format('m');
        $yearDate  = Carbon::now()->format('Y');

        $totalOrders = Order::count();
        $todayOrder  = Order::whereDate('created_at', Carbon::now())->count();
        $monthOrder  = Order::whereMonth('created_at', $monthDate)->count();
        $yearOrder   = Order::whereYear('created_at', $yearDate)->count();

        return view(
            'admin.dashboard',
            compact(
                'totalProducts',
                'totalCategories',
                'totalBrands',
                'totalUsers',
                'totalOrders',
                'todayOrder',
                'monthOrder',
                'yearOrder'
            )
        );
    }
}
