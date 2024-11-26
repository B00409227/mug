<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Main database seeder class that populates the database with initial data
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with default users and other data.
     * Creates three default users with different roles: admin, merchant, and regular user.
     */
    public function run(): void
    {
        // Create Admin user with full administrative privileges
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),  // Hash password for security
            'role' => 'admin',
        ]);

        // Create Merchant user for vendor-specific functionality
        User::create([
            'name' => 'Merchant',
            'email' => 'merchant@example.com',
            'password' => Hash::make('password'),
            'role' => 'merchant',
        ]);

        // Create standard user with basic privileges
        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Run the MugSeeder to populate mug-related data
        $this->call(MugSeeder::class);
    }
}
