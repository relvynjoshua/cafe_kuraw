<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks to allow truncation
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate the categories table
        Category::truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Define an array of categories
        $categories = [
            ['name' => 'Espresso-Based Coffee'],
            ['name' => 'Milk Tea'],
            ['name' => 'Non-Coffee'],
            ['name' => 'Snacks'],
            ['name' => 'Waffle'],
            ['name' => 'Ramen'],
            ['name' => 'Utensils'],
            ['name' => 'Machines'],
            ['name' => 'Equipment'],
            ['name' => 'Cleaning Supplies'],
            ['name' => 'Electronics'],
            ['name' => 'Packaging Items'],
            ['name' => 'Condiments'], // New category
            ['name' => 'Cooking Ingredients'], // New category
            ['name' => 'Vegetables'], // New category
            ['name' => 'Dairy'], // New category
        ];

        // Insert categories into the database
        foreach ($categories as $category) {
            Category::create($category);
        }

        // Optional: Print success message
        $this->command->info('Categories table truncated and seeded successfully with new entries!');
    }
}
