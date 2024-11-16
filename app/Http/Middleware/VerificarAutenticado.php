<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerificarAutenticado
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            toastr()->error('Debes autenticarte antes de continuar');

            return redirect()->intended(route('iniciar-sesion'));
        }

        return $next($request);
    }
}
