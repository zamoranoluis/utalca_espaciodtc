<?php

namespace App\Livewire\Privada\Usuarios;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Mutar extends Component
{
    use WithFileUploads;

    public string $id;

    public string $email;

    public string $nombres;

    public string $apellidos;

    public string $password;

    public $foto;

    public string $path_foto = '';

    public function transformarEnWebpYGuardarDirectorioPublico()
    {
        // Get the file path
        $pathFotoLivewire = $this->foto->getPathName();

        // Create the directory if it doesn't exist
        $directorio = storage_path('app/public/fotos');
        if (!file_exists($directorio)) {
            mkdir($directorio, 0755, true);
        }

        // Generate a unique file name
        $nombreArchivo = uniqid('usuario_') . '.webp';

        // Get the image's extension to handle different formats
        $extension = strtolower($this->foto->getClientOriginalExtension());

        // Create image resource based on extension
        switch ($extension) {
            case 'jpeg':
            case 'jpg':
                $image = imagecreatefromjpeg($pathFotoLivewire);
                break;
            case 'png':
                $image = imagecreatefrompng($pathFotoLivewire);
                break;
            default:
                toastr()->error('Tipo de archivo no permitido');

                return;
        }

        imagewebp($image, $directorio . '/' . $nombreArchivo, 50);

        imagedestroy($image);

        if (!file_exists(public_path('storage'))) {
            Artisan::call('storage:link');
        }

        return "storage/fotos/$nombreArchivo";
    }

    public function existePorEmail(): bool
    {
        return DB::table('users')
            ->where('email', $this->email)
            ->exists();
    }

    public function crearUsuario()
    {
        $this->validate([
            'email' => config('reglas_verificacion.usuario.email'),
            'nombres' => config('reglas_verificacion.usuario.nombres'),
            'apellidos' => config('reglas_verificacion.usuario.apellidos'),
            'password' => config('reglas_verificacion.usuario.password'),
            'foto' => config('reglas_verificacion.usuario.foto'),
        ]);

        if ($this->existePorEmail()) {
            toastr()->error('Ya existe un usuario con ese email');

            return;
        }

        $pathFoto = $this->transformarEnWebpYGuardarDirectorioPublico();

        User::create([
            'email' => $this->email,
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'password' => Hash::make($this->password),
            'path_foto' => $pathFoto,
        ]);

        toastr()->success('Usuario creado correctamente');
    }

    public function editarUsuario(bool $editarFoto, bool $editarContrasena)
    {
        $this->validate([
            'email' => config('reglas_verificacion.usuario.email'),
            'nombres' => config('reglas_verificacion.usuario.nombres'),
            'apellidos' => config('reglas_verificacion.usuario.apellidos')
        ]);

        $usuario = User::where('id', $this->id)->first();
        if ($this->existePorEmail() && $usuario->email != $this->email) {
            toastr()->error('Ya existe un usuario con ese email');
        } else {
            $usuario->email = $this->email;
            $usuario->nombres = $this->nombres;
            $usuario->apellidos = $this->apellidos;


            if ($editarFoto) {
                $this->validate([
                    'foto' => config('reglas_verificacion.usuario.foto')
                ]);

                $pathFoto = $this->transformarEnWebpYGuardarDirectorioPublico();
                $usuario->path_foto = $pathFoto;
                $this->path_foto = $pathFoto;
            }

            if ($editarContrasena) {
                $this->validate([
                    'password' => config('reglas_verificacion.usuario.password')
                ]);

                $usuario->password = Hash::make($this->password);
            }

            $usuario->save();
            toastr()->success('Usuario actualizado correctamente');
        }

    }

    public function mount(?string $id = null)
    {
        $usuario = DB::table('users')
            ->select('users.*')
            ->where('id', '=', $id)
            ->first();

        if ($usuario) {
            $this->id = $usuario->id;
            $this->email = $usuario->email;
            $this->nombres = $usuario->nombres;
            $this->apellidos = $usuario->apellidos;
            $this->path_foto = $usuario->path_foto;
        }
    }

    public function render()
    {
        return view('livewire.privada.usuarios.mutar');
    }
}
