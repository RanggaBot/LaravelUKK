<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $totalProduk = Product::count();
        $produkTersedia = Product::where('stock', '>', 0)->count();
        $produkHabis = Product::where('stock', 0)->count();

        return view('auth.dashboard', compact('totalProduk', 'produkTersedia', 'produkHabis'));
    }
}