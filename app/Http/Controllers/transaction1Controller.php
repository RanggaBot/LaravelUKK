<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class transaction1Controller extends Controller
{
    public function index()
    {
        return view("auth.transactions");
    }
}
