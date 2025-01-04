<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Admin User
        User::create([
            'firstname' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Set a secure password
            'role' => 'admin', // Role for admin
        ]);

        // Seed Regular User
        User::create([
            'firstname' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'), // Set a secure password
            'role' => 'user', // Role for regular user
        ]);

        // Seed Cashier User
        User::create([
            'firstname' => 'Cashier',
            'email' => 'cashier@example.com',
            'password' => Hash::make('password'), // Set a secure password
            'role' => 'cashier', // Role for regular user
        ]);
    }
}
