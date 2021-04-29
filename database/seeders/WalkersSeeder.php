<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalkersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('walkers')->insert([
            'schedule' => "Lunes - Jueves de 9:00a.m hasta 2:00p.m",
            'experience'=>"5",
            'user_id' => "1",
            'slogan' => "Paseo a tu perro",
            'rate' => "7500"
        ]); 

        DB::table('walkers')->insert([
            'schedule' => "Lunes - Jueves de 9:00a.m hasta 2:00p.m",
            'experience'=>"2",
            'user_id' => "4",
            'slogan' => "Paseo a tu perro mejor que nadie",
            'rate' => "1500"
        ]); 

        DB::table('walkers')->insert([
            'schedule' => "Lunes - Jueves de 9:00a.m hasta 2:00p.m",
            'experience'=>"0",
            'user_id' => "7",
            'slogan' => "Paseo a tu perro y tu iguana como si no hubiera mañana",
            'rate' => "1200"
        ]); 
    }
}
