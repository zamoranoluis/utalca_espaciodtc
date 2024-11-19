<?php

namespace App\Livewire\Autenticacion;

use App\Mail\CodigoSesionMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class VerificacionDeIdentidad extends Component
{
    public ?string $email = null;

    public ?string $nombres = null;

    public ?string $codigo = null;

    public function cerrarSesion(string $mensajeError)
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        toastr()->error($mensajeError);

        return redirect()->to(route('iniciar-sesion'));
    }

    public function enviarEmail()
    {
        $emails_enviados = session()->get('emails_enviados');
        $max_emails = config('session.max_email_validar_codigo');
        $email_restantes = $max_emails - $emails_enviados;

        if ($email_restantes > 0) {
            $codigo = Str::random(8);
            session()->put('codigo', $codigo);
            session()->put('emails_enviados', $emails_enviados + 1);

            if (config('session.enviar_codigo_por_correo')) {
                $usuario = Auth::user();

                try {
                    Mail::to($usuario->email)
                        ->send(new CodigoSesionMail(
                            $usuario->nombres,
                            $codigo
                        ));

                } catch (\Exception $e) {
                    toastr()->error('Error al enviar el correo: por favor intente nuevamente');
                }
            } else {
                toastr()->info("Código: $codigo; intentos restantes: $email_restantes");
            }

        } else {
            $this->cerrarSesion('Superaste el máximo de emails enviados para verificar tu identidad, inicia sesión nuevamente');
        }
    }

    // leer: https://laravel.com/docs/11.x/session#storing-data
    public function verificar()
    {
        $this->validate([
            'codigo' => config('reglas_verificacion.usuario.codigo'),
        ]);

        $codigoSesion = session()->get('codigo');
        if ($this->codigo == $codigoSesion) {
            session()->put('2fa', true);
            toastr()->success('Se ha verificado tu identidad ¡Bienvenido/a!');

            return redirect()->intended(route('dashboard'));
        } else {
            $errores_codigo = session()->get('errores_codigo');
            $max_errores = config('session.max_errores_codigo');

            if ($errores_codigo >= $max_errores) {
                $this->cerrarSesion('Superaste el máximo de errores de código, inicia de sesión nuevamente');
            } else {
                session()->put('errores_codigo', $errores_codigo + 1);
                $errores_restantes = $max_errores - $errores_codigo;
                toastr()->error("Codigo invalido, te quedan $errores_restantes intentos");
            }

        }
    }

    public function mount()
    {
        $usuario = Auth::user();
        $this->nombres = $usuario->nombres;
        $this->email = $usuario->email;

        $this->enviarEmail();
    }

    #[Title('Validación de identidad')]
    #[Layout('components.layouts.autenticacion')]
    public function render()
    {
        return view('livewire.autenticacion.verificacion-de-identidad');
    }
}
