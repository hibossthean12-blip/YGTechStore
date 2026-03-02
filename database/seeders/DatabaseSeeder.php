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
            ['id' => 1, 'name' => 'Admin User', 'email' => 'admin@techstore.com', 'password' => Hash::make('password'), 'role' => 'admin', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Note: Products, Categories, and other data are removed as requested.
    }
}
