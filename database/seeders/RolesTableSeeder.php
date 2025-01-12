<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'admin', 'description' => 'Administrator with full permissions', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'user', 'description' => 'Regular user with limited permissions', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'cashier', 'description' => 'Cashier with specific permissions', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}