<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'store_id' => "5", 
            'price' => "10000",
            'name' => "Alimento dog chow 500gr",
            'discount' => "0",
            'quantity' => "20",
            'privacy' => "public",
            'description' => "Alimento premium para perros",

        ]); 

        DB::table('products')->insert([
            'store_id' => "5", 
            'price' => "18000",
            'name' => "Alimento dog chow 1000gr",
            'discount' => "0",
            'quantity' => "20",
            'privacy' => "public",
            'description' => "Alimento premium para perros",

        ]); 

        DB::table('products')->insert([
            'store_id' => "6", 
            'price' => "5000",
            'name' => "Shampoo Canino",
            'discount' => "0",
            'quantity' => "10",
            'privacy' => "public",
            'description' => "Shampoo premium para perros",

        ]); 

        DB::table('products')->insert([
            'store_id' => "7", 
            'price' => "10000",
            'name' => "Cama Negra",
            'discount' => "10",
            'quantity' => "20",
            'privacy' => "public",
            'description' => "Cama acolchonada para animalitos medianos",
        ]); 

        DB::table('products')->insert([
            'store_id' => "7", 
            'price' => "8000",
            'name' => "Alimento dog chow 500gr",
            'discount' => "0",
            'quantity' => "20",
            'description' => "Alimento premium para perros seniors",
            'privacy' => "public",
        ]); 
        DB::table('products')->insert([
            'store_id' => "5", 
            'price' => "50000",
            'name' => "consulta medica",
            'type' => "servicio",
            'discount' => "0",
            'quantity' => "5",
            'privacy' => "public",
            'description' => "Consulta general para mascotas",
        ]); 
        DB::table('products')->insert([
            'store_id' => "8", 
            'price' => "10000",
            'name' => "Alimento dog chow 500gr",
            'discount' => "0",
            'quantity' => "50",
            'privacy' => "public",
            'description' => "Alimento premium para perros",

        ]); 
        DB::table('products')->insert([
            'store_id' => "9", 
            'price' => "50000",
            'name' => "Alimento dog chow 250gr",
            'discount' => "0",
            'quantity' => "100",
            'privacy' => "public",
            'description' => "Alimento premium para perros",
        ]); 
    }
}