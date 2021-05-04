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
            'experience'=>"5",
            'user_id' => "1",
            'slogan' => "Paseo a tu perro",
        ]); 

        DB::table('walkers')->insert([
            'experience'=>"2",
            'user_id' => "4",
            'slogan' => "Paseo a tu perro mejor que nadie",
        ]); 

        DB::table('walkers')->insert([
            'experience'=>"0",
            'user_id' => "7",
            'slogan' => "Paseo a tu perro y tu iguana como si no hubiera mañana",
        ]); 
    }
}
