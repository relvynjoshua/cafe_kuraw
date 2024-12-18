<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
        ];

        // Insert categories into the database
        foreach ($categories as $category) {
            Category::create($category);
        }

        // Optional: Print success message
        $this->command->info('Categories table seeded successfully!');
    }
}
