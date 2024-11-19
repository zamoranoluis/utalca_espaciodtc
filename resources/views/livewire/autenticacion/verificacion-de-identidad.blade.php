<div class="popup autenticacion__popup__grid">
    <div class="popup__relleno">

    </div>
    <div class="popup__header">
        <h2>
            Sistema de Autenticación
        </h2>
    </div>

    <div class="popup__cerrar">
    </div>

    <form class="popup__contenido autenticacion__popup__grid__contenido" wire:submit="verificar()">
        <div class="popup__contenido__entradas">
            <div class="popup__contenido__entradas__flex autenticacion__centrar">

                <div class="popup__contenido__entradas__flex__entry">
                    <p>
                        Estimado/a {{$nombres}}, hemos enviado un código a tu correo electronico {{$email}}, el cual debes adjuntar a continuación.
                    </p>
                </div>

                <div class="popup__contenido__entradas__flex__entry">
                    <p wire:click="enviarEmail()">
                        Si crees no haberlo recibido, haz click aquí
                    </p>
                </div>

                <div class="popup__contenido__entradas__flex__entry">
                    <label>Codigo:</label>
                    <input wire:model="codigo">
                    <p class="error"> @error('codigo')
                        {{ $message }}
                        @enderror
                    </p>
                </div>


            </div>
        </div>

        <div class="popup__grid__contenido__botonera">
            <button type="submit">
                Verificar
            </button>
        </div>
    </form>
</div>
