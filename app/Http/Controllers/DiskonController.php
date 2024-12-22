<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use Illuminate\Http\Request;

class DiskonController extends Controller
{
    // Menampilkan daftar diskon
    public function index()
    {
        $diskon = Diskon::all(); // Ambil semua diskon
        return view('diskon.index', compact('diskon'));
    }

    // Menampilkan form tambah diskon
    public function create()
    {
        return view('diskon.create');
    }

    // Menyimpan diskon baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_diskon' => 'required|max:50',
            'persentase' => 'nullable|numeric|min:0|max:100',
            'nominal' => 'nullable|numeric|min:0',
            'tanggal_mulai' => 'required|date|before_or_equal:tanggal_berakhir',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        Diskon::create($request->all());

        return redirect()->route('diskon.index')->with('success', 'Diskon berhasil ditambahkan.');
    }

    // Menampilkan form edit diskon
    public function edit($id_diskon)
    {
        $diskon = Diskon::findOrFail($id_diskon); // Cari data berdasarkan id
        return view('diskon.edit', compact('diskon'));
    }

    // Memperbarui diskon
    public function update(Request $request, $id_diskon)
    {
        $request->validate([
            'nama_diskon' => 'required|max:50',
            'persentase' => 'nullable|numeric|min:0|max:100',
            'nominal' => 'nullable|numeric|min:0',
            'tanggal_mulai' => 'required|date|before_or_equal:tanggal_berakhir',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $diskon = Diskon::findOrFail($id_diskon);
        $diskon->update($request->all());

        return redirect()->route('diskon.index')->with('success', 'Diskon berhasil diperbarui.');
    }

    // Menghapus diskon
    public function destroy($id_diskon)
    {
        $diskon = Diskon::findOrFail($id_diskon);
        $diskon->delete();

        return redirect()->route('diskon.index')->with('success', 'Diskon berhasil dihapus.');
    }
}
