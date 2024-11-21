<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class nosotrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('nosotros')->insert([[
            'email'=>'cartagen@gmail.com',
        ],[
            'email'=>'league@gmail.com',
        ],[
            'email'=>'cardeal@gmail.com',
        ]
    ]);
    }
}
