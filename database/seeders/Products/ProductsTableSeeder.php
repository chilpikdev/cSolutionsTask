<?php

namespace Database\Seeders\Products;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'title' => 'HDD 1TB',
                'quantiy' => 55,
                'price' => 74.09,
                'created_at' => now(),
            ],
            [
                'title' => 'HDD SSD 512GB',
                'quantiy' => 102,
                'price' => 190.99,
                'created_at' => now(),
            ],
            [
                'title' => 'RAM DDR4 16GB',
                'quantiy' => 47,
                'price' => 80.32,
                'created_at' => now(),
            ],
        ];

        Product::insert($products);
    }
}
