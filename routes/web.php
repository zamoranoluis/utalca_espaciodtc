<?php

use App\Http\Middleware\RedirigirSiPaso2FA;
use App\Http\Middleware\RedirigirSiPasoIniciarSesion;
use App\Http\Middleware\Verificar2FA;
use App\Http\Middleware\VerificarAutenticado;
use App\Livewire\Autenticacion\IniciarSesion;
use App\Livewire\Autenticacion\VerificacionDeIdentidad;
use App\Livewire\Privada\Dashboard;
use App\Livewire\Privada\Usuarios\Lista;
use App\Livewire\Privada\Usuarios\Mutar;

Route::middleware([
    RedirigirSiPasoIniciarSesion::class,
])->group(function () {
    Route::get('/autenticacion/iniciar-sesion',
        IniciarSesion::class)->name('iniciar-sesion');
});

Route::middleware([
    VerificarAutenticado::class,
    RedirigirSiPaso2FA::class,
])->group(function () {
    Route::get('/autenticacion/verificacion-de-identidad',
        VerificacionDeIdentidad::class)->name('verificacion-de-identidad');
});

Route::middleware([
    VerificarAutenticado::class,
    Verificar2FA::class,
])->group(function () {
    Route::get('/plataforma/inicio',
        Dashboard::class)->name('dashboard');
    Route::get('/usuarios', Lista::class);
    Route::get('/usuarios/anadir', Mutar::class);
    Route::get('/usuarios/editar/{id}', Mutar::class);
});
