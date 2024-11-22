<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'email' => env('ADMIN_EMAIL'),
            'nombres' => env('ADMIN_NAMES'),
            'apellidos' => env('ADMIN_LASTNAMES'),
            'password' => Hash::make(env('ADMIN_PASSWORD')),
            'path_foto' => '',
        ]);
    }
}
