<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class crearcuentaseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    DB::table('_crear_cuenta')->insert([[
            'correo'=>'Cacahuate@gmail.com',
            'contraseña'=> 'cacahuatejapones3',
        ],[
            'correo'=>'Taco@gmail.com',
            'contraseña'=> 'TacoCampechano9',
        ],[
            'correo'=>'ArrozconLeche@gmail.com',
            'contraseña'=> 'Canela345',
        ]]);
    }
}