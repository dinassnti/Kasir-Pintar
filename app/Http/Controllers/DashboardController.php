<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        // Ambil data jumlah produk dan pelanggan
        $jumlahProduk = Produk::count();
        $jumlahPelanggan = Pelanggan::count();
        
        // Kirim data ke view
        return view('dashboard', compact('jumlahProduk', 'jumlahPelanggan'));
    }
}

