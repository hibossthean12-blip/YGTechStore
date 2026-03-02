<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Wipe all existing data to ensure a clean state as requested
        // Using TRUNCATE CASCADE to handle foreign key dependencies in Postgres
        DB::statement('TRUNCATE TABLE users, categories, products, product_ratings, carts, cart_items, orders, order_items, contact_messages RESTART IDENTITY CASCADE');

        // Users
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin User',
                'email' => 'admin@techstore.com', 
                'password' => Hash::make('password'), 
                'role' => 'admin', 
                'created_at' => now(), 
                'updated_at' => now()
            ]
        ]);

        // Categories
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Audio', 'slug' => 'audio'],
            ['id' => 2, 'name' => 'Wearables', 'slug' => 'wearables'],
            ['id' => 3, 'name' => 'Computers', 'slug' => 'computers'],
            ['id' => 4, 'name' => 'Photography', 'slug' => 'photography'],
            ['id' => 5, 'name' => 'Accessories', 'slug' => 'accessories'],
            ['id' => 6, 'name' => 'Mobile', 'slug' => 'mobile'],
        ]);

        // Note: Products and other data remain removed as requested.
    }
}
