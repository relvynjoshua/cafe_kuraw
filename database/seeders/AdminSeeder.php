<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'firstname' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Set a secure password
            'role' => 'admin', // Make sure this matches your isAdmin() check
        ]);
    }
}
