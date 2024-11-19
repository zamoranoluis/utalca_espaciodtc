<?php

namespace App\Livewire\Autenticacion;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class IniciarSesion extends Component
{
    public ?string $email = null;

    public ?string $password = null;

    public function iniciarSesion()
    {
        $this->validate([
            'email' => config('reglas_verificacion.usuario.email'),
            'password' => config('reglas_verificacion.usuario.password'),
        ]);

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        // si efectivamente las credenciales coinciden
        if (Auth::attempt($credentials)) {
            Session::regenerate();

            session()->put('2fa', false);
            session()->put('errores_codigo', 0);
            session()->put('emails_enviados', 0);

            return redirect()->intended(route('verificacion-de-identidad'));
        }

        toastr()->error('Credenciales incorrectas');

        return back();
    }

    #[Title('Iniciar Sesion')]
    #[Layout('components.layouts.autenticacion')]
    public function render()
    {
        return view('livewire.autenticacion.iniciar-sesion');
    }
}
