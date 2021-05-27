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
            'password' => Hash::make('12345678')
        ]); 

        DB::table('users')->insert([
            'name' => "Pepe", //ID 2
            'lastname'=>"Tendero",
            'email' => "tendero@correo.com",
            'document' => '1045682145',
            'phone' => '3126280234',
            'password' => Hash::make('12345678')
        ]); 

        DB::table('users')->insert([
            'name' => "Luis", //ID 3
            'lastname'=>"Dueño mascota",
            'email' => "dueno@correo.com",
            'document' => '1005689242',
            'phone' => '80000000',
            'password' => Hash::make('12345678')
        ]); 

        DB::table('users')->insert([
            'name' => "Juanito", //ID 4
            'lastname'=>"Pasea Perro",
            'email' => "paseador@correo.com",
            'document' => '1002636279',
            'phone' => '89054204',
            'password' => Hash::make('12345678')
        ]); 

        DB::table('users')->insert([
            'name' => "Pepe", //ID 5
            'lastname'=>"perro",
            'email' => "pp@correo.edu.co",
            'document' => '1045682188',
            'phone' => '312628034',
            'password' => Hash::make('12345678')
        ]); 

        DB::table('users')->insert([
            'name' => "Luis", //ID 6
            'lastname'=>"Dueño mascota",
            'email' => "perez@correo.com",
            'document' => '105689242',
            'phone' => '80000400',
            'password' => Hash::make('hola123')
        ]);

        DB::table('users')->insert([
            'name' => "peranito", //ID 7
            'lastname'=>"Paseador",
            'email' => "juanp@correo.edu.co",
            'document' => '1102636277',
            'phone' => '89225420',
            'password' => Hash::make('supersecret')
        ]); 

        DB::table('users')->insert([
            'name' => "Pepe", //ID 8
            'lastname'=>"Tendero",
            'email' => "pepito222@correo.edu.co",
            'document' => '104682145',
            'phone' => '2126284434',
            'password' => Hash::make('secretisima')
        ]); 

        DB::table('users')->insert([
            'name' => "Luis", //ID 9
            'lastname'=>"Dueño mascota",
            'email' => "luis@correo.edu.co",
            'document' => '105559242',
            'phone' => '8007000',
            'password' => Hash::make('hola123')
        ]); 

        DB::table('users')->insert([
            'name' => "Luis Alberto", //ID 10
            'lastname'=>"Lopez",
            'email' => "luis222@correo.edu.co",
            'document' => '135559242',
            'phone' => '8007050',
            'password' => Hash::make('12345678')
        ]); 

        DB::table('users')->insert([
            'name' => "Luisa ", //ID 11
            'lastname'=>"Lopez Marin",
            'email' => "luisa222@correo.edu.co",
            'document' => '335559242',
            'phone' => '8337050',
            'password' => Hash::make('12345678')
        ]); 

        DB::table('users')->insert([
            'name' => "Mauricio Alberto", //ID 9
            'lastname'=>"Lopez",
            'email' => "maluis222@correo.edu.co",
            'document' => '135559332',
            'phone' => '8012050',
            'password' => Hash::make('12345678')
        ]); 
    }
}
