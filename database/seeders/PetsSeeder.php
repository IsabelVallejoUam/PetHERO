<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pets')->insert([
            'name' => "Lolo", //Cambiar id en caso de error
            'species' => "dog",
            'race' => "Labrador",
            'owner_id' => "3",
            'sex' => "masculine",
            'age' => "5",
            'commentary' => "Es muy lindo",
            'personality' => "calm",
            'size' => "tiny",
        ]); 
    }
}
