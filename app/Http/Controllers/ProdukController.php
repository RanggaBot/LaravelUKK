<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Product::all();
        return view('auth.Produk', compact('produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        $produk = Product::all();
        return view('auth.Produk', compact('produk'))->with('success', 'Produk berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        
        return redirect()->route('Produk')->with('success', 'Produk berhasil dihapus');
    }

    public function kurangiStok($id)
    {
        $product = Product::findOrFail($id);
        
        if ($product->stock > 0) {
            $product->stock -= 1;
            $product->save();
            return redirect()->route('Produk')->with('success', 'Stok produk berhasil dikurangi');
        } else {
            return redirect()->route('Produk')->with('error', 'Stok produk sudah habis');
        }
    }
}