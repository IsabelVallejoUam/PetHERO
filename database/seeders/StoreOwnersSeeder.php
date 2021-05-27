<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoreOwnersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('store_owners')->insert([
            'user_id' => "2" //Cambiar id en caso de error
        ]); 

        DB::table('store_owners')->insert([
            'user_id' => "8" //Cambiar id en caso de error
        ]); 

        DB::table('store_owners')->insert([
            'user_id' => "9" //Cambiar id en caso de error
        ]); 

        DB::table('store_owners')->insert([
            'user_id' => "10" //Cambiar id en caso de error
        ]); 

        DB::table('store_owners')->insert([
            'user_id' => "11" //Cambiar id en caso de error
        ]); 

        DB::table('store_owners')->insert([
            'user_id' => "12" //Cambiar id en caso de error
        ]); 
    }
}
