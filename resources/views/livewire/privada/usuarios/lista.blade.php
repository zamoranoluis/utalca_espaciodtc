<div>
    <div>
        <a href="/usuarios/anadir" wire:navigate>Anadir usuario</a>
        <h1>Listado usuario</h1>
    </div>
    <div>
        @foreach($usuarios as $usuario)
            <p>{{$usuario->email}}</p>
            <a href="/usuarios/editar/{{$usuario->id}}" wire:navigate>Editar</a>
        @endforeach
    </div>

</div>
