<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class laporanController extends Controller
{
    public function index(Request $request)
    {
        // Definisikan $startDate dan $endDate
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->startOfMonth();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now();
    
        // Gunakan $startDate dan $endDate untuk query
        $sales = Sale::whereBetween('sale_date', [$startDate, $endDate])->with('product')->get();
    
        $totalSales = $sales->sum('total_price');
        $totalQuantity = $sales->sum('quantity');
    
        $productSales = $sales->groupBy('product_id')->map(function ($productSales) {
            $product = $productSales->first()->product;
            return [
                'product' => $product,
                'quantity' => $productSales->sum('quantity'),
                'total_price' => $productSales->sum('total_price'),
            ];
        })->values();
    
        // Kirim data ke view
        return view('auth.laporan', compact('sales', 'totalSales', 'totalQuantity', 'productSales', 'startDate', 'endDate'));
    }
}
