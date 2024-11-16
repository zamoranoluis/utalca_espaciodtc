<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirigirSiPasoIniciarSesion
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            return redirect()->intended(route('verificacion-de-identidad'));
        }

        return $next($request);
    }
}
