<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataStaff;
use Illuminate\Support\Facades\Auth;

class DataStaffController extends Controller
{
    public function index()
    {
        $dataStaff = DataStaff::all();
        return view('data_staff.index', compact('dataStaff'));
    }

    public function create()
    {
        return view('data_staff.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:data_staff,email',
            'no_telepon' => 'required|string|max:15',
            'level_akses' => 'required|in:Kasir',
            'alamat' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        $dataStaff = new DataStaff();
        $dataStaff->nama = $validated['nama'];
        $dataStaff->email = $validated['email'];
        $dataStaff->no_telepon = $validated['no_telepon'];
        $dataStaff->level_akses = $validated['level_akses'];
        $dataStaff->alamat = $validated['alamat'];
        $dataStaff->password = bcrypt($validated['password']);

        if (Auth::check()) {
            $dataStaff->id_user = Auth::id();
        } else {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu untuk menambahkan data staff.');
        }

        $dataStaff->save();

        return redirect()->route('data_staff.index')->with('success', 'Data staff berhasil ditambahkan.');
    }

    public function edit($id_data_staff)
    {
        $staff = DataStaff::findOrFail($id_data_staff);
        return view('data_staff.edit', compact('staff'));
    }

    public function update(Request $request, $id_data_staff)
    {
        // Cari data staff berdasarkan primary key (id_data_staff)
        $staff = DataStaff::findOrFail($id_data_staff);
    
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:data_staff,email,' . $id_data_staff . ',id_data_staff',
            'no_telepon' => 'required|string|max:15',
            'level_akses' => 'required|in:Kasir',
            'alamat' => 'required|string',
        ]);
    
        // Update data staff
        $staff->update($validated);
    
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('data_staff.index')->with('success', 'Data staff berhasil diperbarui.');
    }    

    public function destroy($id)
    {
        $staff = DataStaff::findOrFail($id_data_staff);
        $staff->delete();

        return redirect()->route('data_staff.index');
    }
}