<div x-data="{
    anadir: {{$id == null ? 1 : 0}},
    editarFoto: 0,
    editarContrasena: 0,
}">
    <div>
        <a href="/usuarios" wire:navigate>Volver a listado de usuarios</a>
        <h1 x-text="anadir == 1 ? 'Añadir usuario' : 'Editar usuario'"></h1>
    </div>
    <form
        @if($id == null)
            wire:submit="crearUsuario()"
        @else
            wire:submit="editarUsuario()"
        @endif
    >

        <img x-show="anadir == '0'" style="height: 200px; width: 200px; border-radius: 50%" src="{{asset("$path_foto")}}"/>

        <div>
            <div>Email</div>
            <input wire:model="email">
            <p @error('email')
                {{ $message }}
                @enderror
            </p>
        </div>

        <div>
            <div>Nombres</div>
            <input wire:model="nombres">
            <p @error('nombres')
            {{ $message }}
            @enderror
            </p>
        </div>

        <div>
            <div>Apellidos</div>
            <input wire:model="apellidos">
            <p @error('apellidos')
            {{ $message }}
            @enderror
            </p>
        </div>

        <div x-show="anadir == '0'">
            <label>¿Deseas editar la contraseña?</label>
            <select x-model="editarContrasena">
                <option selected value="0">No</option>
                <option value="1">Sí</option>
            </select>
        </div>

        <div x-show="anadir == '1' || anadir == '0' && editarContrasena == '1'">
            <div>Contraseña:</div>
            <input wire:model="password">
            <p @error('password')
            {{ $message }}
            @enderror
            </p>
        </div>

        <div x-show="anadir == '0'">
            <label>¿Deseas editar la foto?</label>
            <select x-model="editarFoto">
                <option selected value="0">No</option>
                <option value="1">Sí</option>
            </select>
        </div>

        <div x-show="anadir == '1' || anadir == '0' && editarFoto == '1'">
            <label>Fotografia</label>
            <input type="file" wire:model="foto">
            <p @error('foto')
            {{ $message }}
            @enderror
            </p>
        </div>

        <button type="submit">
            @if($id == null)
                Anadir usuario
            @else
                Editar usuario
            @endif
        </button>

    </form>
</div>
