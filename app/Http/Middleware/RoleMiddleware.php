<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //users
        if (!Auth::check() || Auth::user()->role !== $role) {
            abort(403, 'Unauthorized');
        }

        return $next($request);

        //kategori
        if (auth()->user()->role !== $role) {
            return redirect('/')->with('error', 'Akses ditolak');
        }
        return $next($request);

        //email
        if (User::where('email', $request->email)->where('id_user', '<>', $request->user()->id_user)->exists()) {
            return redirect()->back()->withErrors(['email' => 'Email sudah digunakan oleh pengguna lain.']);
        }
    }
}
