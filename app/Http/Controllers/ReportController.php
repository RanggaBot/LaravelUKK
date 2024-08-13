<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth());

        $sales = Sale::whereBetween('sale_date', [$startDate, $endDate])
            ->with('product')
            ->get();

        $totalSales = $sales->sum('total_price');
        $totalQuantity = $sales->sum('quantity');

        $productSales = $sales->groupBy('product_id')
            ->map(function ($group) {
                return [
                    'product' => $group->first()->product,
                    'quantity' => $group->sum('quantity'),
                    'total_price' => $group->sum('total_price'),
                ];
            })
            ->sortByDesc('total_price');

        return view('auth.laporan', compact('sales', 'totalSales', 'totalQuantity', 'productSales', 'startDate', 'endDate'));
    }
}