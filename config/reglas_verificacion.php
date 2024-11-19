<?php

return [
    'usuario' => [
        // notar que email_utalca es personalizado y estará en AppServiceProvider
        // en el metodo boot
        'email' => ['required', 'string', 'email_utalca', 'max:50'],
        'nombres' => 'required|string|min:2|max:30',
        'apellidos' => 'required|string|min:2|max:30',
        'password' => 'required|string|min:8|max:30',
        'habilitado' => 'required|boolean',
        'foto' => 'required|mimes:jpeg,png,jpg|max:2048',
        'codigo' => 'required|min:8|max:8',
    ],
];
