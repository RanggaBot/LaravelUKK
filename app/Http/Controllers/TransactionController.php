<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::orderBy('created_at', 'desc')->get();
        return view('auth.transactions', compact('transactions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'total' => 'required|numeric',
        ]);

        $transaction = Transaction::create($request->all());

        return response()->json([
            'success' => true,
            'transaction' => $transaction
        ]);
    }
}