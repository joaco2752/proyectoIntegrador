<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class loginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('login')->insert([[
            'correo'=>'Cocacola@gmail.com',
            'contraseña'=> 'cocasinazucar',
        ],[
            'correo'=>'Torta@gmail.com',
            'contraseña'=> 'TortaCubana',
        ],[
            'correo'=>'AguadeHorchata@gmail.com',
            'contraseña'=> 'Horchata123',
        ]]);
    }
}
