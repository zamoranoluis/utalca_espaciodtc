<?php

namespace App\Livewire\Privada\Usuarios;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Anadir extends Component
{
    public $modo = 'anadir';
    public $id;

    public $email;

    public $nombres;

    public $apellidos;

    public $password;

    public function crearUsuario()
    {
        User::create([
            'email' => $this->email,
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'password' => Hash::make($this->password),
        ]);

        toastr()->success('Usuario creado correctamente');
    }

    public function editarUsuario()
    {
        if($this->id != null){
            User::where("id","=",$this->id)->update([
                'email' => $this->email,
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
            ]);

            toastr()->success('Usuario actualizado correctamente');
        }
    }

    public function mount($id)
    {
        $usuario = User::where('id', $id)->first();

        if($usuario){
            $this->id = $usuario->id;
            $this->modo = 'editar';
            $this->email = $usuario->email;
            $this->nombres = $usuario->nombres;
            $this->apellidos = $usuario->apellidos;
        }
    }

    public function render()
    {
        return view('livewire.privada.usuarios.anadir');
    }
}
