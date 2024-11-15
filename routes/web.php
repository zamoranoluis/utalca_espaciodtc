<?php

use App\Livewire\Autenticacion\IniciarSesion;
use App\Livewire\Autenticacion\VerificacionDeIdentidad;

Route::get('/autenticacion/iniciar-sesion',
    IniciarSesion::class)->name('iniciar-sesion');
Route::get('/autenticacion/verificacion-de-identidad',
    VerificacionDeIdentidad::class)->name('verificacion-de-identidad');
