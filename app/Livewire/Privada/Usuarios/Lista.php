<?php

namespace App\Livewire\Privada\Usuarios;

use App\Models\User;
use Livewire\Component;

class Lista extends Component
{
    public function render()
    {
        return view('livewire.privada.usuarios.lista', [
            'usuarios' => User::all(),
        ]);
    }
}
