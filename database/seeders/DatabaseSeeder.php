<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Wipe products and other data to ensure a clean state
        // We use a try-catch for TRUNCATE to prevent lock-waits from failing the whole deploy
        try {
            DB::statement('TRUNCATE TABLE products, product_ratings, carts, cart_items, orders, order_items, contact_messages RESTART IDENTITY CASCADE');
        } catch (\Exception $e) {
            // If truncate fails due to a lock, manually delete what we can
            DB::table('products')->delete();
        }

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
    }
}
