<div x-data="{
    mostrarContrasena: false,
    tipoInputContrasena(){
        return this.mostrarContrasena ? 'text' : 'password';
    },
}" class="popup autenticacion__popup__grid">
    <div class="popup__relleno">

    </div>
    <div class="popup__header">
        <h2>
            Sistema de Autenticación
        </h2>
    </div>

    <div class="popup__cerrar">
    </div>

    <form class="popup__contenido autenticacion__popup__grid__contenido" wire:submit="iniciarSesion()">
        <div class="popup__contenido__entradas">
            <div class="popup__contenido__entradas__flex autenticacion__centrar">

                <div class="popup__contenido__entradas__flex__entry">
                    <label>Email:</label>
                    <input wire:model="email">
                    <p class="error"> @error('email')
                        {{ $message }}
                        @enderror
                    </p>
                </div>

                <div class="popup__contenido__entradas__flex__entry">
                    <label>Contraseña:</label>
                    <div class="input__type__password">
                        <input x-bind:type="tipoInputContrasena" wire:model="password">
                        <img x-on:click="mostrarContrasena = !mostrarContrasena" x-show="mostrarContrasena == false" src="{{asset('iconos/contrasena_visible.png')}}">
                        <img x-on:click="mostrarContrasena = !mostrarContrasena" x-show="mostrarContrasena == true" src="{{asset('iconos/contrasena_oculta.png')}}">
                    </div>
                    <p class="error"> @error('password')
                        {{ $message }}
                        @enderror
                    </p>
                </div>
            </div>
        </div>

        <div class="popup__grid__contenido__botonera">
            <button type="submit">
                Iniciar sesión
            </button>
        </div>
    </form>
</div>
