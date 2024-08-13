<?php

namespace App\Http\Controllers;

use App\Models\penjualan;
use Illuminate\Http\Request;

class DashboardPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard_penjualan.index', [
            'penjualans' => Penjualan::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard_penjualan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id'      => 'required',
            'produk_id'         => 'required',
            'jumlah_produk'     => 'required',
            'total_harga'       => 'required',
            'subtotal'          => 'required',
            'tanggal_penjualan' => 'required',
        ]);


        Penjualan::create([
            'pelanggan_id'      => $request->pelanggan_id,
            'produk_id'         => $request->produk_id,
            'jumlah_produk'     => $request->jumlah_produk,
            'total_harga'       => $request->total_harga,
            'subtotal'          => $request->subtotal,
            'tanggal_penjualan' => $request->tanggal_penjualan,
            'created_at'        => now(),
        ]);

        return redirect()->route('dashboard_penjualan.index')->with(['success' => 'Data Penjualan Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('dashboard_penjualan.show', ['data' => Penjualan::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('dashboard_penjualan.edit', ['data' => Penjualan::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'pelanggan_id'      => 'required|numeric',
            'produk_id'         => 'required|numeric',
            'jumlah_produk'     => 'required|numeric',
            'total_harga'       => 'required|numeric',
            'subtotal'          => 'required|numeric',
            'tanggal_penjualan' => 'required|date',
        ]);

        $penjualan = Penjualan::findOrFail($id);

        $penjualan->update([
            'pelanggan_id'      => $request->pelanggan_id,
            'produk_id'         => $request->produk_id,
            'jumlah_produk'     => $request->jumlah_produk,
            'total_harga'       => $request->total_harga,
            'subtotal'          => $request->subtotal,
            'tanggal_penjualan' => $request->tanggal_penjualan,
        ]);

        return redirect()->route('dashboard_penjualan.index')->with(['success' => 'Data Penjualan Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Penjualan::findOrFail($id)->delete();

        return redirect()->route('dashboard_penjualan.index')->with(['success' => 'Data Penjualan Berhasil Dihapus!']);
    }
}