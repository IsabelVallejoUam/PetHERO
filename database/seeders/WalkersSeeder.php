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
            'user_id' => "1"
        ]); 
    }
}
