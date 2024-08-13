<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction; // Pastikan Anda memiliki model Transaction

class KasirController extends Controller
{
    public function index()
    {
        $transactions = Transaction::latest()->get(); // Ambil semua transaksi, urutkan dari yang terbaru
        return view('auth.kasir', compact('transactions'));
    }
    public function addSale(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
    ]);

    $product = Product::findOrFail($request->product_id);
    $totalPrice = $product->price * $request->quantity;

    Sale::create([
        'product_id' => $request->product_id,
        'quantity' => $request->quantity,
        'total_price' => $totalPrice,
        'sale_date' => now(),
    ]);

    return redirect()->back()->with('success', 'Penjualan berhasil ditambahkan');
}
}