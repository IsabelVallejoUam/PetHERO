<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Juan", //ID 1
            'lastname'=>"Paseador",
            'email' => "juanp.zapataa@autonoma.edu.co",
            'document' => '1002636277',
            'phone' => '8905420',
            'password' => Hash::make('supersecret')
        ]); 

        DB::table('users')->insert([
            'name' => "Pepe", //ID 2
            'lastname'=>"Tendero",
            'email' => "pepito@autonoma.edu.co",
            'document' => '1045682145',
            'phone' => '3126280234',
            'password' => Hash::make('secretisima')
        ]); 

        DB::table('users')->insert([
            'name' => "Luis", //ID 3
            'lastname'=>"Dueño mascota",
            'email' => "luisito@autonoma.edu.co",
            'document' => '1005689242',
            'phone' => '80000000',
            'password' => Hash::make('hola123')
        ]); 
    }
}
