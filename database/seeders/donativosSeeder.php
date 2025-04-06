<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class donativosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('donativos')->insert([[
            'nombre'=>'Alejandro',
            'correo'=>'Alejandro@gmail.com',
            'cantidad'=> '200',
            'metodo_pago'=>'Credit Card',
        ],[
            'nombre'=>'Gerardo',
            'correo'=>'Gerardo@gmail.com',
            'cantidad'=> '500',
            'metodo_pago'=>'Cryptocurrency',
        ],[
            'nombre'=>'Maria',
            'correo'=>'Maria@gmail.com',
            'cantidad'=> '100',
            'metodo_pago'=>'PayPal',
        ]
    ]);
    }
}
