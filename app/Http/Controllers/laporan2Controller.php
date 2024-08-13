<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Laporan2Controller extends Controller
{
    // Tambahkan metode-metode yang Anda perlukan di sini
    public function index(Request $request)
    {
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->startOfMonth();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now();
    
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
    
        $soldProductIds = $productSales->pluck('product.id');
        $unsoldProducts = Product::whereNotIn('id', $soldProductIds)->get();
    
        return view('auth.laporan', compact('startDate', 'endDate', 'sales', 'totalSales', 'totalQuantity', 'productSales', 'unsoldProducts'));
    }

    // Metode lain sesuai kebutuhan...
}