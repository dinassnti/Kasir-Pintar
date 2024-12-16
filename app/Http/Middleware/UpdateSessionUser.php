<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class UpdateSessionUser
{
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            DB::table('sessions')
                ->where('id', session()->getId())
                ->update(['user_id' => auth()->id()]);
        }

        return $next($request);
    }
}
