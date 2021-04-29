<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PetOwnersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pet_owners')->insert([
            'user_id' => "3", //Cambiar id en caso de error
            'address' => "su casa"
        ]); 

        DB::table('pet_owners')->insert([
            'user_id' => "5", //Cambiar id en caso de error
            'address' => "la casa en la colina"
        ]); 

        DB::table('pet_owners')->insert([
            'user_id' => "6", //Cambiar id en caso de error
            'address' => "cr 24"
        ]); 

        DB::table('pet_owners')->insert([
            'user_id' => "9", //Cambiar id en caso de error
            'address' => "su casa, pero la grande"
        ]); 
    }
}
