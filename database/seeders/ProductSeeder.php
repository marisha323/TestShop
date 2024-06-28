<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Product 1',
                'description' => 'Description for product 1',
                'price' => 10.00,
                'images' => 'images/image_test_1.jpg',
            ],
            [
                'name' => 'Product 2',
                'description' => 'Description for product 2',
                'price' => 20.00,
                'images' => 'images/image_test_2.jpg',
            ],
            [
                'name' => 'Product 3',
                'description' => 'Description for product 3',
                'price' => 30.00,
                'images' => 'images/image_test_3.jpg',
            ],
            [
                'name' => 'Product 4',
                'description' => 'Description for product 4',
                'price' => 60.00,
                'images' => 'images/image_test_4.jpg',
            ],
            [
                'name' => 'Product 5',
                'description' => 'Description for product 5',
                'price' => 37.00,
                'images' => 'images/image_test_5.jpg',
            ],
            [
                'name' => 'Product 6',
                'description' => 'Description for product 6',
                'price' => 47.00,
                'images' => 'images/image_test_6.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
