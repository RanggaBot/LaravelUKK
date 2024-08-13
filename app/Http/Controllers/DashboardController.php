<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::getTotalProducts();
        $lowStockProducts = Product::getLowStockProducts();

        $todayTransactions = Sale::getTodayTransactions();

        $salesData = Sale::selectRaw('DATE(sale_date) as date, SUM(total_price) as total')
            ->whereBetween('sale_date', [Carbon::now()->subDays(7), Carbon::now()])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $latestProducts = Product::latest()->take(5)->get();

        return view('auth.dashboard', compact(
            'totalProducts',
            'lowStockProducts',
            'todayTransactions',
            'salesData',
            'latestProducts'
        ));
    }
}