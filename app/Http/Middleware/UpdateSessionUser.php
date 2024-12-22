<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use App\Models\Session;

class UpdateSessionUser
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->id() !== null) {
            Session::updateOrCreate(
                ['id' => session()->getId()],
                ['id_user' => auth()->id()]
            );
        }
    
        return $next($request);
    }
}
