<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // User Statistics
        $totalUsers = User::count();
        $activeUsers = User::where('status', 'active')->count();
        $recentUsers = User::latest()->take(5)->get();

        // Product Statistics
        $totalProducts = Product::count();
        $activeProducts = Product::where('status', 1)->count();

        // Category Statistics
        $totalCategories = ProductCategory::count();
        $activeCategories = ProductCategory::where('status', 1)->count();

        return view('dashboard', compact(
            'totalUsers',
            'activeUsers',
            'recentUsers',
            'totalProducts',
            'activeProducts',
            'totalCategories',
            'activeCategories'
        ));
    }
}
