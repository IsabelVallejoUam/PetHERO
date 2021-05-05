<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            WalkersSeeder::class,
            PetOwnersSeeder::class,
            StoreOwnersSeeder::class,
            StoresSeeder::class,
            ProductsSeeder::class,
            RoutesSeeder::class,
            PetsSeeder::class
        ]);
    }
}
