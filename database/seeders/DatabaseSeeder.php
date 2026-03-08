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
    }
}
