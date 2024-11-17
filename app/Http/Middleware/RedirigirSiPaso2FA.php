<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirigirSiPaso2FA
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->exists('2fa')) {
            if ($request->session()->get('2fa') == true) {
                return redirect()->intended(route('dashboard'));
            }
        }

        return $next($request);
    }
}
