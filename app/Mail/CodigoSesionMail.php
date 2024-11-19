<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CodigoSesionMail extends Mailable
{
    use Queueable, SerializesModels;

    public ?string $nombre = null;

    public ?string $codigo = null;

    public function __construct(string $nombre, string $codigo)
    {
        $this->nombre = $nombre;
        $this->codigo = $codigo;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Correo Codigo Acceso',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.codigo-sesion',
            with: [
                'nombre' => $this->nombre,
                'codigo' => $this->codigo,
            ],
        );
    }
}
