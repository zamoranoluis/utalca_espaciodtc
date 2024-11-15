<?php

return [
    'required' => 'El campo :attribute es obligatorio.',
    'email' => 'El campo :attribute debe ser una dirección de correo electrónico válida.',
    'mimes' => 'El campo :attribute debe ser un archivo de tipo: :values.',
    'min' => [
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
        'numeric' => 'El campo :attribute debe ser al menos :min.',
    ],
    'max' => [
        'string' => 'El campo :attribute debe tener máximo :max caracteres.',
        'numeric' => 'El campo :attribute debe ser máximo :min.',
        'file' => 'El campo :attribute no debe ser mayor que :max kilobytes.',
    ],

    'attributes' => [
        'email' => 'correo electrónico',
        'password' => 'contraseña',
    ],
];
