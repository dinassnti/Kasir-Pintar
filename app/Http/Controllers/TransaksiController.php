<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatTransaksi;
use App\Models\Produk;

class TransaksiController extends Controller
{
    public function index()
    {
        // Ambil data transaksi dari database
        $transaksi = Transaksi::with('pelanggan')->get(); // Sesuaikan relasi 'pelanggan' jika ada
        
        // Kirim data ke view
        return view('transaksi.index', compact('transaksi'));
    }

    public function proses(Request $request)
    {
        $validated = $request->validate([
            'produk' => 'required|array',
            'produk.*.id_produk' => 'required|exists:produk,id_produk',
            'produk.*.jumlah' => 'required|integer|min:1',
        ]);

        // Mulai Transaksi
        $totalHarga = 0;
        $produkDetails = [];

        foreach ($request->produk as $item) {
            $produk = Produk::find($item['id_produk']);
            $subtotal = $produk->harga * $item['jumlah'];

            // Validasi Stok
            if ($produk->stok < $item['jumlah']) {
                return back()->withErrors(["Produk {$produk->nama_produk} stok tidak mencukupi."]);
            }

            $produkDetails[] = [
                'id_produk' => $produk->id_produk,
                'jumlah' => $item['jumlah'],
                'harga' => $produk->harga,
                'subtotal' => $subtotal,
            ];

            $totalHarga += $subtotal;

            // Kurangi Stok
            $produk->stok -= $item['jumlah'];
            $produk->save();
        }

        // Simpan Transaksi
        $transaksi = Transaksi::create([
            'nomor_transaksi' => uniqid('TRX-'),
            'total_harga' => $totalHarga,
            'status_pembayaran' => 'Belum Dibayar',
            'id_user' => auth()->id(),
        ]);

        // Simpan Detail Transaksi
        foreach ($produkDetails as $detail) {
            TransaksiDetail::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'id_produk' => $detail['id_produk'],
                'jumlah' => $detail['jumlah'],
                'harga' => $detail['harga'],
                'subtotal' => $detail['subtotal'],
            ]);
        }

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diproses.');
    }

    public function storeTransaksi(Request $request)
    {
        // Validasi dan simpan transaksi
        $transaksi = new Transaksi();
        $transaksi->pelanggan_id = $request->pelanggan_id;
        $transaksi->total_harga = $request->total_harga;
        $transaksi->save();

        // Ambil pelanggan dan update poin
        $pelanggan = Pelanggan::findOrFail($request->pelanggan_id);
        $pelanggan->point += $request->total_harga * 0.1; // Misalnya, 10% dari total harga adalah poin yang didapat
        $pelanggan->save();

        // Redirect dengan pesan sukses
        return redirect()->route('pelanggan.index')->with('success', 'Transaksi berhasil dan poin pelanggan diperbarui.');
    }
}