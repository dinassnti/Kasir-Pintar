<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Produk;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/users', function () {
    return User::all();
});

// Halaman Reset Password
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

//dashboard
Route::get('/dashboard', [DashboardController::class, '__construct'])->middleware('auth')->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Logout
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::middleware('role:Owner')->group(function () {
    Route::resource('kategori', KategoriController::class);
});

//profil
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/password/update', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth', 'update_session_user']], function () {
    // Rute yang dilindungi login
});

//Produk
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
Route::resource('produk', ProdukController::class);
//Stok
Route::get('/stok', [StokController::class, 'index'])->name('stok.index');
Route::post('/stok/{id}/update', [StokController::class, 'update'])->name('stok.update');
//kategori
Route::resource('kategori', KategoriController::class);
//transaksi
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::resource('/transaksi', TransaksiController::class);
Route::post('/transaksi/proses', [TransaksiController::class, 'proses'])->name('transaksi.proses');
//pelanggan
Route::get('pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
Route::get('pelanggan/{id_pelanggan}/edit', [PelangganController::class, 'edit'])->name('pelanggan.edit');
Route::put('pelanggan/{id_pelanggan}', [PelangganController::class, 'update'])->name('pelanggan.update');
Route::delete('pelanggan/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');
Route::resource('pelanggan', PelangganController::class);
//laporan
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
//Diskon
Route::resource('diskon', DiskonController::class);

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [HomeController::class, 'index']);



