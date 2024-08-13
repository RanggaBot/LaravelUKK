<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\gantipasswordController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});


Route::get('/testing', function () {
    return view('test');
});

Route::get('/daftar', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});
Route::get('/gantipassword', function () {
    return view('gantipassword');
});
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');

Route::get('/kasir', function () {
    return view('kasir');
});
Route::get('/kasir', function () {
    return view('kasir');
})->name('kasir');

Route::get('/kasir', [KasirController::class, 'dashboard'])->name('kasir.dashboard')->middleware('auth');
Route::get('/kasir', [KasirController::class, 'index'])->name('kasir');

Route::get('/gantipassword', [gantipasswordController::class, 'dashboard'])->name('gantipassword.dashboard')->middleware('auth');
Route::get('/gantipassword', [gantipasswordController::class, 'index'])->name('gantipassword');

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');

// Halaman dashboard

Route::get('/produk', [ProdukController::class, 'index'])->name('Produk');
Route::post('/produk', [ProdukController::class, 'store'])->name('Produk');

// Fungsi middleware('auth') digunakan untuk memproteksikan semua pengguna agar tidak bisa langsung masuk melainkan harus login terlebih dahulu
Route::get('/dashboard', [AdminController::class,'index'])->name('dashboard')->middleware('auth');
// Halaman login
    Route::get('/login', [SessionController::class,'index'])->name('login');
    Route::post('/login-proses', [SessionController::class,'login_proses'])->name('login-proses');
    Route::get('/logout', [SessionController::class,'logout'])->name('logout');

    // Halaman register
    Route::get('/register', [SessionController::class, 'register'])->name('register');
    Route::post('/register-proses', [SessionController::class,'register_proses'])->name('register-proses');

Route::get('/admin/dashboard', 'AdminDashboardController@index')->name('admin.dahsboard');
Route::put('/admin/dashboard/{id}', 'AdminDashboardController@update')->name('admin.dahsboard.update');
Route::resource('/dashboard_penjualan', DashboardPenjualanController::class)->names('dashboard_penjualan');


Route::get('/data/admin', function () {
    return view('admin.layoutadmin');
}
);

Route::post('/kasir/add-to-cart', [KasirController::class, 'addToCart'])->name('kasir.addToCart');
Route::post('/kasir/process-payment', [KasirController::class, 'processPayment'])->name('kasir.processPayment');

Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');

Route::get('/laporan2', [LaporanController::class, 'index'])->name('laporan2.index');

Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('hapus.produk');
Route::patch('/produk/{id}/kurangi-stok', [ProdukController::class, 'kurangiStok'])->name('kurangi.stok');
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');