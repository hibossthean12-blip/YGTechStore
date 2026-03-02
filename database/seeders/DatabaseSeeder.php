<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Users
        DB::table('users')->insert([
            ['id' => 1, 'name' => 'Admin User', 'email' => 'admin@techstore.com', 'password' => Hash::make('password'), 'role' => 'admin', 'created_at' => '2024-01-01 00:00:00', 'updated_at' => '2024-01-01 00:00:00'],
            ['id' => 2, 'name' => 'John Doe', 'email' => 'john@example.com', 'password' => Hash::make('password'), 'role' => 'customer', 'created_at' => '2024-01-10 09:00:00', 'updated_at' => '2024-01-10 09:00:00'],
            ['id' => 3, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'password' => Hash::make('password'), 'role' => 'customer', 'created_at' => '2024-01-15 10:30:00', 'updated_at' => '2024-01-15 10:30:00'],
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

        // Products
        DB::table('products')->insert([
            ['id' => 1, 'category_id' => 1, 'name' => 'Premium Wireless Headphones', 'description' => 'High-quality over-ear wireless headphones with noise cancellation', 'price' => 299.99, 'stock' => 50, 'image_url' => 'images/headphones.jpg', 'is_featured' => 1],
            ['id' => 2, 'category_id' => 1, 'name' => 'True Wireless Earbuds Pro', 'description' => 'Premium TWS earbuds with skull art design and long battery life', 'price' => 179.99, 'stock' => 80, 'image_url' => 'images/earbuds.jpg', 'is_featured' => 1],
            ['id' => 3, 'category_id' => 2, 'name' => 'Smart Fitness Watch', 'description' => 'GPS fitness tracker with heart rate monitor and multiple sport modes', 'price' => 249.99, 'stock' => 60, 'image_url' => 'images/smartwatch.jpg', 'is_featured' => 1],
            ['id' => 4, 'category_id' => 3, 'name' => 'Ultra-Thin Laptop 15"', 'description' => 'Slim and powerful 15-inch laptop for professionals', 'price' => 1299.99, 'stock' => 25, 'image_url' => 'images/laptop.jpg', 'is_featured' => 1],
            ['id' => 5, 'category_id' => 4, 'name' => 'Professional DSLR Camera', 'description' => 'High-resolution DSLR camera for professional photography', 'price' => 899.99, 'stock' => 20, 'image_url' => 'images/camera.jpg', 'is_featured' => 0],
            ['id' => 6, 'category_id' => 5, 'name' => 'RGB Mechanical Keyboard', 'description' => 'Tactile mechanical keyboard with full RGB backlighting', 'price' => 129.99, 'stock' => 100, 'image_url' => 'images/keyboard.jpg', 'is_featured' => 0],
            ['id' => 7, 'category_id' => 5, 'name' => 'Travel Luggage Set', 'description' => 'Lightweight carry-on luggage for frequent travelers', 'price' => 199.99, 'stock' => 40, 'image_url' => 'images/luggage.jpg', 'is_featured' => 0],
            ['id' => 8, 'category_id' => 6, 'name' => 'Hexnode Smartphone', 'description' => 'Android smartphone with enterprise MDM support', 'price' => 649.99, 'stock' => 35, 'image_url' => 'images/smartphone.jpg', 'is_featured' => 0],
            ['id' => 9, 'category_id' => 2, 'name' => 'Smart Watch Series X', 'description' => 'Next-generation smartwatch with advanced health monitoring', 'price' => 349.99, 'stock' => 45, 'image_url' => 'images/smartwatch2.jpg', 'is_featured' => 0],
        ]);

        // Product Ratings
        DB::table('product_ratings')->insert([
            ['id' => 1, 'product_id' => 1, 'user_id' => 2, 'rating' => 3.5, 'review' => 'Great headphones, very comfortable for long sessions', 'created_at' => '2024-02-01 00:00:00'],
            ['id' => 2, 'product_id' => 1, 'user_id' => 3, 'rating' => 4.0, 'review' => 'Excellent sound quality, absolutely worth the price', 'created_at' => '2024-02-03 00:00:00'],
            ['id' => 3, 'product_id' => 2, 'user_id' => 2, 'rating' => 3.5, 'review' => 'Good earbuds, cool skull design, solid battery life', 'created_at' => '2024-02-05 00:00:00'],
            ['id' => 4, 'product_id' => 3, 'user_id' => 3, 'rating' => 4.0, 'review' => 'Accurate fitness tracking, sleek and modern design', 'created_at' => '2024-02-07 00:00:00'],
            ['id' => 5, 'product_id' => 4, 'user_id' => 2, 'rating' => 3.5, 'review' => 'Fast and powerful laptop, impressively thin and light', 'created_at' => '2024-02-08 00:00:00'],
        ]);

        // Carts
        DB::table('carts')->insert([
            ['id' => 1, 'user_id' => 2, 'status' => 'active'],
        ]);

        // Cart Items
        DB::table('cart_items')->insert([
            ['id' => 1, 'cart_id' => 1, 'product_id' => 1, 'quantity' => 1],
        ]);

        // Orders
        DB::table('orders')->insert([
            ['id' => 1, 'user_id' => 2, 'total_amount' => 299.99, 'status' => 'delivered', 'shipping_address' => '123 Main St, San Francisco, CA 94102', 'created_at' => '2024-02-01 10:00:00', 'updated_at' => '2024-02-05 15:00:00'],
            ['id' => 2, 'user_id' => 3, 'total_amount' => 1479.98, 'status' => 'processing', 'shipping_address' => '456 Oak Ave, Los Angeles, CA 90001', 'created_at' => '2024-02-08 14:00:00', 'updated_at' => '2024-02-08 14:00:00'],
        ]);

        // Order Items
        DB::table('order_items')->insert([
            ['id' => 1, 'order_id' => 1, 'product_id' => 1, 'quantity' => 1, 'price' => 299.99],
            ['id' => 2, 'order_id' => 2, 'product_id' => 4, 'quantity' => 1, 'price' => 1299.99],
            ['id' => 3, 'order_id' => 2, 'product_id' => 2, 'quantity' => 1, 'price' => 179.99],
        ]);

        // Contact Messages
        DB::table('contact_messages')->insert([
            ['id' => 1, 'first_name' => 'John', 'last_name' => 'Doe', 'email' => 'john@example.com', 'phone' => '+1-555-0100', 'subject' => 'Order Inquiry', 'message' => 'When will my order #1 arrive?', 'status' => 'replied'],
            ['id' => 2, 'first_name' => 'Jane', 'last_name' => 'Smith', 'email' => 'jane@example.com', 'phone' => null, 'subject' => 'Return Request', 'message' => 'I would like to return my laptop purchase.', 'status' => 'pending'],
        ]);
    }
}
