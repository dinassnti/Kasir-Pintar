<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User; // Pastikan model User diimport
use App\Providers\RouteServiceProvider;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function showLoginForm()
    {
    return view('auth.login');
    }


    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);
    
        // Validasi status akun
        $user = User::where('email', $request->email)->first();
        if (!$user || $user->status !== 'Aktif') {
            throw ValidationException::withMessages([
                'email' => 'Akun ini tidak aktif atau tidak terdaftar.',
            ]);
        }

        // Proses login menggunakan Auth::attempt
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Login berhasil, arahkan ke dashboard
            return redirect()->route('dashboard');
        }
    
        // Login gagal
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);

        // Regenerasi session setelah login
        $request->session()->regenerate();

        // Simpan email ke session untuk keperluan lebih lanjut
        $request->session()->put('email', $request->email);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
