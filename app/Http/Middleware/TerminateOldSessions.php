<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TerminateOldSessions
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // Hentikan sesi jika pengguna diubah
            Auth::logoutOtherDevices(request('password'));
        }

        return $next($request);
    }
}
