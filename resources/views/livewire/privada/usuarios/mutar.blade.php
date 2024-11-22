<div>
    <div>
        <a href="/usuarios" wire:navigate>Volver a listado de usuarios</a>
        <h1>Crear usuario</h1>
    </div>
    <form
        @if($id != null)
            wire:submit="crearUsuario()"
        @else
            wire:submit="editarUsuario()"
        @endif
    >
        <div>
            <div>Email</div>
            <input wire:model="email">
        </div>

        <div>
            <div>Nombres</div>
            <input wire:model="nombres">
        </div>

        <div>
            <div>Apellidos</div>
            <input wire:model="apellidos">
        </div>

        @if($id == null)
            <div>
                <div>Contrasena</div>
                <input wire:model="password">
            </div>
        @endif

        <button type="submit">
            @if($id == null)
                Anadir usuario
            @else
                Editar usuario
            @endif
        </button>
    </form>
</div>
