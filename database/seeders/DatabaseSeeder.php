<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        // Users - Use updateOrInsert so it NEVER fails the build
        DB::table('users')->updateOrInsert(
            ['id' => 1],
            [
                'name' => 'Admin User',
                'email' => 'admin@techstore.com', 
                'password' => Hash::make('password'), 
                'role' => 'admin', 
                'created_at' => now(), 
                'updated_at' => now()
            ]
        );

        // Categories - Use updateOrInsert so it NEVER fails the build
        $categories = [
            ['id' => 1, 'name' => 'Audio', 'slug' => 'audio'],
            ['id' => 2, 'name' => 'Wearables', 'slug' => 'wearables'],
            ['id' => 3, 'name' => 'Computers', 'slug' => 'computers'],
            ['id' => 4, 'name' => 'Photography', 'slug' => 'photography'],
            ['id' => 5, 'name' => 'Accessories', 'slug' => 'accessories'],
            ['id' => 6, 'name' => 'Mobile', 'slug' => 'mobile'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->updateOrInsert(['id' => $category['id']], $category);
        }

        // Products - Use updateOrInsert
        $products = [
            [
                'id' => 1,
                'category_id' => 2, // Wearables
                'name' => 'Pink Headset',
                'description' => 'A stylish pink gaming headset with noise cancellation and superior audio.',
                'price' => 50.00,
                'stock' => 10,
                'image_url' => 'images/pink_headset.png',
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'category_id' => 3, // Computers
                'name' => 'ASUS TUF F15',
                'description' => 'High-performance gaming laptop with a sleek design and powerful graphics.',
                'price' => 1150.00,
                'stock' => 5,
                'image_url' => 'images/asus_laptop.png',
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($products as $product) {
            DB::table('products')->updateOrInsert(['id' => $product['id']], $product);
        }
    }
}
