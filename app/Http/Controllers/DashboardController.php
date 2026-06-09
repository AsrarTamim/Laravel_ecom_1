<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products'   => Product::count(),
            'categories' => Category::count(),
            'orders'     => Order::count(),
            'revenue'    => Order::sum('total'),
            'users'      => User::count(),
        ];

        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recentOrders'));
    }
}