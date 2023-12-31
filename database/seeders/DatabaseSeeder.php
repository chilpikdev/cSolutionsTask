<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\Products\ProductsTableSeeder;
use Database\Seeders\Users\UsersPermissionsSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersPermissionsSeeder::class,
            ProductsTableSeeder::class,
        ]);
    }
}
