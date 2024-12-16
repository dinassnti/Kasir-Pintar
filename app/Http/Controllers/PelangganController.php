<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::all(); // Nama variabel $pelanggan
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        // Menampilkan halaman form tambah pelanggan
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggans,email',
            'no_telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        // Simpan data pelanggan tanpa kolom point
        Pelanggan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'point' => 0, // Default point adalah 0
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id); // Pastikan ID valid
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggans,email,' . $id . ',id_pelanggan',
            'no_telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        // Cari pelanggan berdasarkan ID
        $pelanggan = Pelanggan::findOrFail($id);

        // Update data pelanggan
        $pelanggan->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Mencari pelanggan berdasarkan id dan menghapusnya
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus.');
    }
}
