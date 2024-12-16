<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with('kategori')->get(); // Mengambil produk beserta kategori
        return view('produk.index', compact('produk'));
    }

    public function create()
    {
        // Ambil semua data kategori dari database
        $kategori = Kategori::all();
    
        // Kirim data kategori ke view
        return view('produk.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'kode_barang' => 'required|unique:produk,kode_barang|max:100',
            'nama_produk' => 'required|string|max:255',
            'harga_dasar' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0|gte:harga_dasar',
            'stok' => 'required|integer|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $produk = new Produk();
        $produk->id_kategori = $request->id_kategori;
        $produk->kode_barang = $request->kode_barang;
        $produk->nama_produk = $request->nama_produk;
        $produk->harga_dasar = $request->harga_dasar;
        $produk->harga_jual = $request->harga_jual;
        $produk->stok = $request->stok;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $produk->foto = $filename;
        }

        $produk->save();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::all(); // Pastikan ada model Kategori
        return view('produk.edit', compact('produk', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'kode_barang' => 'required|string|max:50|unique:produk,kode_barang,' . $id . ',id_produk',
            'nama_produk' => 'required|string|max:255',
            'harga_dasar' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0|gte:harga_dasar',
            'stok' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10048',
        ]);
    
        // Cari produk berdasarkan ID
        $produk = Produk::findOrFail($id);
    
        // Update data produk
        $produk->id_kategori = $validated['id_kategori'];
        $produk->kode_barang = $validated['kode_barang'];
        $produk->nama_produk = $validated['nama_produk'];
        $produk->harga_dasar = $validated['harga_dasar'];
        $produk->harga_jual = $validated['harga_jual'];
        $produk->stok = $validated['stok'];
    
        // Perbarui foto jika ada file baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($produk->foto && file_exists(public_path('uploads/' . $produk->foto))) {
                unlink(public_path('uploads/' . $produk->foto));
            }
    
            // Simpan foto baru
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $produk->foto = $filename;
        }
    
        // Simpan perubahan
        $produk->save();
    
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        if ($produk->foto && file_exists(public_path('uploads/' . $produk->foto))) {
            unlink(public_path('uploads/' . $produk->foto));
        }
        $produk->delete();
    
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}

