<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Verificar2FA
{
    // leer: https://laravel.com/docs/11.x/session
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->exists('2fa')) {
            if ($request->session()->get('2fa') == true) {
                return $next($request);
            } else {
                toastr()->error('Debes verificar tu identidad antes de continuar');

                return redirect()->intended(route('verificacion-de-identidad'));
            }
        } else {
            toastr()->error('Debes verificar tu identidad antes de continuar');

            return redirect()->intended(route('verificacion-de-identidad'));
        }

    }
}
