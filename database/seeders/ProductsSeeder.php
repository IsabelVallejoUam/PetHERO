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
            'store_id' => "3", 
            'price' => "10000",
            'name' => "Alimento dog chow 500gr",
            'discount' => "0",
            'quantity' => "20",
            'description' => "Alimento premium para perros",
            'photo' => "/public/images/products/docg_chow.png"
        ]); 
    }
}
