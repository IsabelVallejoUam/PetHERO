<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoutesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('routes')->insert([
            'owner_id' => "1", //Cambiar id en caso de error
            'duration' => "3",
            'title' => "Ruta bosque popular",
            'description' => "Vamos hasta el bosque popular",
            'schedule' => "Lunes y viernes de 4 a 7 p.m",
            'price' => "10000",
            'privacy' => "public",
        ]); 
    }
}
