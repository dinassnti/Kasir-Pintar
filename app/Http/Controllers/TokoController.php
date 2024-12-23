<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokoController extends Controller
{
    public function show()
    {
        $toko = Toko::first(); // Ambil data toko pertama
        return view('toko.show', compact('toko'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_usaha' => 'required|string|max:255',
            'nama_toko' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
            'foto_toko' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('foto_toko');

        if ($request->hasFile('foto_toko')) {
            $file = $request->file('foto_toko');
            $path = $file->store('toko_foto', 'public');
            $data['foto_toko'] = $path; // Simpan path ke database
        }

        $data['id_user'] = Auth::id();
        Toko::create($data);

        return redirect()->route('toko.show')->with('success', 'Profil toko berhasil disimpan.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'jenis_usaha' => 'required|string|max:255',
            'nama_toko' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
            'foto_toko' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $toko = Toko::first();
        $data = $request->except('foto_toko');

        if ($request->hasFile('foto_toko')) {
            if ($toko->foto_toko) {
                \Storage::delete('public/' . $toko->foto_toko);
            }
            $data['foto_toko'] = $request->file('foto_toko')->store('toko', 'public');
        }

        $toko->update($data);

        return redirect()->route('toko.show')->with('success', 'Profil toko berhasil diperbarui.');
    }
}