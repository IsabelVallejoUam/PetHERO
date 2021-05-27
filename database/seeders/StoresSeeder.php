<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stores')->insert([
            'owner_id' => "2", //Cambiar id en caso de error
            'store_name' => "Veterinaria de prueba",
            'nit' => "123456789",
            'description' => "Esta es una veterinaria muy linda de prueba",
            'schedule' => "Lunes a viernes de 7:00 a.m hasta 5:00 p.m",
            'address' => "P.Sherman calle wallaby 42 Sidney",
            'phone_number' => "8900000"
        ]); 

        DB::table('stores')->insert([
            'owner_id' => "8", //Cambiar id en caso de error
            'store_name' => "Tienda y mas",
            'nit' => "126456789",
            'description' => "Esta es una tienda muy linda de prueba",
            'schedule' => "Lunes a viernes de 7:00 a.m hasta 5:00 p.m",
            'address' => "P.Sherman calle wallaby 42 Sidney",
            'phone_number' => "8905500"
        ]); 

        DB::table('stores')->insert([
            'owner_id' => "8", //Cambiar id en caso de error
            'store_name' => "los perros de pablito",
            'nit' => "123452789",
            'description' => "Esta es una tienda de barrio muy linda",
            'schedule' => "Lunes a viernes de 7:00 a.m hasta 5:00 p.m",
            'address' => "P.Sherman calle wallaby 42 Sidney",
            'phone_number' => "8902200"
        ]); 

        DB::table('stores')->insert([
            'owner_id' => "9", //Cambiar id en caso de error
            'store_name' => "centro medico",
            'nit' => "123456779",
            'description' => "Esta es una veterinaria ",
            'schedule' => "Lunes a viernes de 7:00 a.m hasta 5:00 p.m",
            'address' => "P.Sherman calle wallaby 42 Sidney",
            'phone_number' => "8900700"
        ]); 

        DB::table('stores')->insert([
            'owner_id' => "10", //Cambiar id en caso de error
            'store_name' => "centro Veterinario Carola",
            'nit' => "123488779",
            'description' => "Esta es una veterinaria excelente servicio",
            'schedule' => "Lunes a viernes de 7:00 a.m hasta 5:00 p.m",
            'address' => "En la carola",
            'phone_number' => "8977700"
        ]); 

        DB::table('stores')->insert([
            'owner_id' => "10", //Cambiar id en caso de error
            'store_name' => "Como Perros y Gatos",
            'nit' => "127756779",
            'description' => "Esta es una tienda de productos para animales ",
            'schedule' => "Lunes a viernes de 7:00 a.m hasta 5:00 p.m",
            'address' => "Cr 23#51-67",
            'phone_number' => "8903200"
        ]); 

        DB::table('stores')->insert([
            'owner_id' => "10", //Cambiar id en caso de error
            'store_name' => "Veggie Pet",
            'nit' => "123451239",
            'description' => "Amigable con el medio ambiente ",
            'schedule' => "Lunes a viernes de 7:00 a.m hasta 5:00 p.m",
            'address' => "Av. Santander",
            'phone_number' => "89007124"
        ]); 

        DB::table('stores')->insert([
            'owner_id' => "11", //Cambiar id en caso de error
            'store_name' => "centro medico especialista",
            'nit' => "123474579",
            'description' => "Esta es una veterinaria solo de gatos",
            'schedule' => "Lunes a viernes de 7:00 a.m hasta 5:00 p.m",
            'address' => "Casa de refugio",
            'phone_number' => "8745700"
        ]); 

        DB::table('stores')->insert([
            'owner_id' => "12", //Cambiar id en caso de error
            'store_name' => "centro de la mascota",
            'nit' => "999456779",
            'description' => "Esta es una tienda respetable ",
            'schedule' => "Lunes a viernes de 7:00 a.m hasta 5:00 p.m",
            'address' => "cr 51#2-6",
            'phone_number' => "8949700"
        ]); 
    }
}
