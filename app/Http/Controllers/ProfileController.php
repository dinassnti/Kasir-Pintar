<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.show');
    }

    // Update Profile
    public function update(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);
    
        // Perbarui pengguna
        $user = auth()->user(); // Mendapatkan pengguna yang sedang login
        $user->nama = $validated['nama'];
        $user->email = $validated['email'];
        $user->save();
    
        // Update session jika perlu
        DB::table('sessions')
            ->where('id', session()->getId())
            ->update(['id_user' => auth()->id()]);

        // Logout dan login ulang setelah perubahan
        auth()->logout();
        auth()->login($user);
    
        return redirect()->route('profile.show');
    }

    // Update Password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        // Ambil data user yang sedang login
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password lama salah.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diperbarui.');
    }

    // Delete Account
    public function destroy()
    {
        $user = Auth::user();
        $user->delete();

        Auth::logout();

        return redirect('/')->with('success', 'Akun berhasil dihapus.');
    }
}
