<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;

class InventorySeeder extends Seeder
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

        // Truncate the inventories table
        Inventory::truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Define inventory seed data
        $inventories = [
            [
                'item_name' => 'Coffee Beans',
                'description' => 'High-quality coffee beans',
                'quantity' => 50,
                'unit' => 'kg',
                'price' => 500.00,
                'category_id' => 1, // Assuming this category exists
                'supplier_id' => 1, // Assuming this supplier exists
                'location' => 'Claro M. Recto Avenue, Cagayan de Oro, 9000 Misamis Oriental',
                'stock_level' => 'Sufficient', // Based on quantity
                
            ],
            [
                'item_name' => 'Natural cow’s Milk',
                'description' => 'Fresh natural milk',
                'quantity' => 20,
                'unit' => 'piece',
                'price' => 80.00,
                'category_id' => 16, // Assuming this category exists
                'supplier_id' => 2, // Assuming this supplier exists
                'location' => 'Kauswagan Highway, Cagayan de Oro City, 9000, Misamis Oriental',
                'stock_level' => 'Sufficient', // Based on quantity
                
            ],
            [
                'item_name' => 'Espresso Machine',
                'description' => 'Machine for brewing espresso',
                'quantity' => 1,
                'unit' => 'unit',
                'price' => 25000.00,
                'category_id' => 8, // Assuming this category exists
                'supplier_id' => 1, // Assuming this supplier exists
                'location' => 'Claro M. Recto Avenue, Cagayan de Oro, 9000 Misamis Oriental',
                'stock_level' => 'Low Stock', // Based on quantity
                
            ],
            [
                'item_name' => 'Coffee Grinder',
                'description' => 'Grinder for coffee beans',
                'quantity' => 1,
                'unit' => 'unit',
                'price' => 20000.00,
                'category_id' => 8, // Assuming this category exists
                'supplier_id' => 1, // Assuming this supplier exists
                'location' => 'Claro M. Recto Avenue, Cagayan de Oro, 9000 Misamis Oriental',
                'stock_level' => 'Low Stock', // Based on quantity
                
            ],
            [
                'item_name' => 'Bukidnon Honey',
                'description' => 'Natural honey from Bukidnon',
                'quantity' => 20,
                'unit' => 'grams',
                'price' => 200.00,
                'category_id' => 3, // Assuming this category exists
                'supplier_id' => 2, // Assuming this supplier exists
                'location' => 'Kauswagan Highway, Cagayan de Oro City, 9000, Misamis Oriental',
                'stock_level' => 'Sufficient', // Based on quantity
                
            ],
            [
                'item_name' => 'Raspberry Syrup',
                'description' => '750ml syrup for Beverages',
                'quantity' => 30,
                'unit' => 'bottle',
                'price' => 150.00,
                'category_id' => 3, // Assuming this category exists
                'supplier_id' => 1, // Assuming this supplier exists
                'location' => 'Claro M. Recto Avenue, Cagayan de Oro, 9000 Misamis Oriental',
                'stock_level' => 'Sufficient', // Based on quantity
                
            ],
            [
                'item_name' => 'Sour Candy Syrup',
                'description' => '750ml syrup for beverages',
                'quantity' => 25,
                'unit' => 'bottle',
                'price' => 200.00,
                'category_id' => 3, // Assuming this category exists
                'supplier_id' => 1, // Assuming this supplier exists
                'location' => 'Claro M. Recto Avenue, Cagayan de Oro, 9000 Misamis Oriental',
                'stock_level' => 'Sufficient', // Based on quantity
                
            ],
            [
                'item_name' => '450ml Mayonaise',
                'description' => 'Creamy condiment for food',
                'quantity' => 15,
                'unit' => 'bottle',
                'price' => 120.00,
                'category_id' => 13, // Assuming this category exists
                'supplier_id' => 1, // Assuming this supplier exists
                'location' => 'Claro M. Recto Avenue, Cagayan de Oro, 9000 Misamis Oriental',
                'stock_level' => 'Sufficient', // Based on quantity
                
            ],
            [
                'item_name' => '200ml Cheez Whiz Pimiento',
                'description' => '200ml Cheez Pimiento',
                'quantity' => 10,
                'unit' => 'bottle',
                'price' => 125.00,
                'category_id' => 13, // Assuming this category exists
                'supplier_id' => 1, // Assuming this supplier exists
                'location' => 'Claro M. Recto Avenue, Cagayan de Oro, 9000 Misamis Oriental',
                'stock_level' => 'Low Stock', // Based on quantity
                
            ],
            [
                'item_name' => 'Ramen Mild Noodles',
                'description' => 'Mild flavored ramen noodles',
                'quantity' => 50,
                'unit' => 'pieces',
                'price' => 155.00,
                'category_id' => 6, // Assuming this category exists
                'supplier_id' => 2, // Assuming this supplier exists
                'location' => 'Kauswagan Highway, Cagayan de Oro City, 9000, Misamis Oriental',
                'stock_level' => 'Sufficient', // Based on quantity
                
            ],
            [
                'item_name' => 'Ramen Spicy Noodles',
                'description' => 'Spicy flavored ramen noodles',
                'quantity' => 50,
                'unit' => 'pieces',
                'price' => 155.00,
                'category_id' => 6, // Assuming this category exists
                'supplier_id' => 2, // Assuming this supplier exists
                'location' => 'Kauswagan Highway, Cagayan de Oro City, 9000, Misamis Oriental',
                'stock_level' => 'Sufficient', // Based on quantity
                
            ],
            [
                'item_name' => 'Waffle Maker',
                'description' => 'Device to make waffles',
                'quantity' => 1,
                'unit' => 'unit',
                'price' => 3000.00,
                'category_id' => 8, // Assuming this category exists
                'supplier_id' => 1, // Assuming this supplier exists
                'location' => 'Claro M. Recto Avenue, Cagayan de Oro City, 9000, Misamis Oriental',
                'stock_level' => 'Low Stock', // Based on quantity
                
            ],
            [
                'item_name' => 'Ice Maker',
                'description' => 'Machine for making ice',
                'quantity' => 1,
                'unit' => 'unit',
                'price' => 999.00,
                'category_id' => 8, // Assuming this category exists
                'supplier_id' => 1, // Assuming this supplier exists
                'location' => 'Claro M. Recto Avenue, Cagayan de Oro City, 9000, Misamis Oriental',
                'stock_level' => 'Low Stock', // Based on quantity
                
            ],
            [
                'item_name' => 'Thermos',
                'description' => 'Insulated container for hot or cold liquids',
                'quantity' => 1,
                'unit' => 'piece',
                'price' => 500.00,
                'category_id' => 9, // Assuming this category exists
                'supplier_id' => 1, // Assuming this supplier exists
                'location' => 'Claro M. Recto Avenue, Cagayan de Oro City, 9000, Misamis Oriental',
                'stock_level' => 'Low Stock', // Based on quantity
                
            ],
            [
                'item_name' => 'Cooler Ice Box',
                'description' => 'Portable box for keeping items cold',
                'quantity' => 1,
                'unit' => 'piece',
                'price' => 800.00,
                'category_id' => 9, // Assuming this category exists
                'supplier_id' => 1, // Assuming this supplier exists
                'location' => 'Claro M. Recto Avenue, Cagayan de Oro City, 9000, Misamis Oriental',
                'stock_level' => 'Low Stock', // Based on quantity
                
            ],
            [
                'item_name' => 'Big Size Sliced Bread',
                'description' => 'Large loaves of sliced bread',
                'quantity' => 20,
                'unit' => 'pieces',
                'price' => 110.00,
                'category_id' => 4, // Assuming this category exists
                'supplier_id' => 2, // Assuming this supplier exists
                'location' => 'Kauswagan Highway, Cagayan de Oro City, 9000, Misamis Oriental',
                'stock_level' => 'Sufficient', // Based on quantity
                
            ],
            [
                'item_name' => 'Oil',
                'description' => 'Cooking Oil for frying and dishes',
                'quantity' => 15,
                'unit' => 'bottle',
                'price' => 85.00,
                'category_id' => 14, // Assuming this category exists
                'supplier_id' => 1, // Assuming this supplier exists
                'location' => 'Claro M. Recto Avenue, Cagayan de Oro, 9000 Misamis Oriental',
                'stock_level' => 'Sufficient', // Based on quantity
                
            ],
            [
                'item_name' => '160g Salted Butter',
                'description' => 'For baking and cooking',
                'quantity' => 10,
                'unit' => 'grams',
                'price' => 100.00,
                'category_id' => 14, // Assuming this category exists
                'supplier_id' => 1, // Assuming this supplier exists
                'location' => 'Claro M. Recto Avenue, Cagayan de Oro, 9000 Misamis Oriental',
                'stock_level' => 'Low Stock', // Based on quantity
                
            ],
            [
                'item_name' => 'Tomatoes',
                'description' => 'Fresh tomatoes for cooking and snacks',
                'quantity' => 15,
                'unit' => 'kg',
                'price' => 120.00,
                'category_id' => 15, // Assuming this category exists
                'supplier_id' => 1, // Assuming this supplier exists
                'location' => 'Claro M. Recto Avenue, Cagayan de Oro, 9000 Misamis Oriental',
                'stock_level' => 'Sufficient', // Based on quantity
                
            ],
            [
                'item_name' => 'Lettuce',
                'description' => 'Fresh lettuce',
                'quantity' => 15,
                'unit' => 'kg',
                'price' => 110.00,
                'category_id' => 15, // Assuming this category exists
                'supplier_id' => 1, // Assuming this supplier exists
                'location' => 'Claro M. Recto Avenue, Cagayan de Oro, 9000 Misamis Oriental',
                'stock_level' => 'Sufficient', // Based on quantity
                
            ],
            [
                'item_name' => '22oz Plastic Cups with Lid',
                'description' => 'Plastic cups for cold beverages',
                'quantity' => 100,
                'unit' => 'pieces',
                'price' => 10.00,
                'category_id' => 12, // Assuming this category exists
                'supplier_id' => 1, // Assuming this supplier exists
                'location' => 'Claro M. Recto Avenue, Cagayan de Oro, 9000 Misamis Oriental',
                'stock_level' => 'High', // Based on quantity
                
            ],
            [
                'item_name' => '16oz Plastic Cups with Lid',
                'description' => 'Plastic cups for cold beverages',
                'quantity' => 100,
                'unit' => 'pieces',
                'price' => 10.00,
                'category_id' => 12, // Assuming this category exists
                'supplier_id' => 1, // Assuming this supplier exists
                'location' => 'Claro M. Recto Avenue, Cagayan de Oro, 9000 Misamis Oriental',
                'stock_level' => 'High', // Based on quantity
                
            ],
            [
                'item_name' => 'Plastic Straw',
                'description' => 'Standard Plastic Straws',
                'quantity' => 90,
                'unit' => 'pieces',
                'price' => 10.00,
                'category_id' => 12, // Assuming this category exists
                'supplier_id' => 1, // Assuming this supplier exists
                'location' => 'Claro M. Recto Avenue, Cagayan de Oro, 9000 Misamis Oriental',
                'stock_level' => 'High', // Based on quantity
                
            ],
            [
                'item_name' => 'Paper Straw',
                'description' => 'Eco-friendly Paper Straws',
                'quantity' => 90,
                'unit' => 'pieces',
                'price' => 10.00,
                'category_id' => 12, // Assuming this category exists
                'supplier_id' => 1, // Assuming this supplier exists
                'location' => 'Claro M. Recto Avenue, Cagayan de Oro, 9000 Misamis Oriental',
                'stock_level' => 'High', // Based on quantity
                
            ],
        ];

        // Insert new inventory data
        foreach ($inventories as $inventory) {
            Inventory::create($inventory);
        }

        // Optional success message
        $this->command->info('Inventory table truncated and seeded successfully with new entries!');
    }
}
