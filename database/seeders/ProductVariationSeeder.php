<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductVariation;

class ProductVariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Product variations categorized based on the menu
        $variations = [
            // Espresso-Based Coffee (product_id 1 - 7)
            ['product_id' => 1, 'type' => 'Hot', 'value' => 'Regular', 'price' => 80],
            ['product_id' => 1, 'type' => 'Iced', 'value' => 'Regular', 'price' => 90],

            ['product_id' => 2, 'type' => 'Hot', 'value' => 'Regular', 'price' => 90],
            ['product_id' => 2, 'type' => 'Iced', 'value' => 'Regular', 'price' => 100],
            ['product_id' => 2, 'type' => 'Iced', 'value' => 'Large', 'price' => 120],

            ['product_id' => 3, 'type' => 'Hot', 'value' => 'Regular', 'price' => 100],

            ['product_id' => 4, 'type' => 'Hot', 'value' => 'Regular', 'price' => 120],

            ['product_id' => 5, 'type' => 'Hot', 'value' => 'Regular', 'price' => 120],
            ['product_id' => 5, 'type' => 'Hot', 'value' => 'Large', 'price' => 135],
            ['product_id' => 5, 'type' => 'Iced', 'value' => 'Regular', 'price' => 135],
            ['product_id' => 5, 'type' => 'Iced', 'value' => 'Large', 'price' => 145],

            ['product_id' => 6, 'type' => 'Hot', 'value' => 'Regular', 'price' => 125],
            ['product_id' => 6, 'type' => 'Hot', 'value' => 'Large', 'price' => 135],
            ['product_id' => 6, 'type' => 'Iced', 'value' => 'Regular', 'price' => 135],
            ['product_id' => 6, 'type' => 'Iced', 'value' => 'Large', 'price' => 145],

            ['product_id' => 7, 'type' => 'Hot', 'value' => 'Regular', 'price' => 130],
            ['product_id' => 7, 'type' => 'Hot', 'value' => 'Large', 'price' => 145],

            // Milk Tea (product_id 8 - 10)
            ['product_id' => 8, 'type' => 'Regular', 'value' => '16 oz', 'price' => 59],
            ['product_id' => 9, 'type' => 'Regular', 'value' => '16 oz', 'price' => 59],
            ['product_id' => 10, 'type' => 'Regular', 'value' => '16 oz', 'price' => 59],

            // Non-Coffee (product_id 11 - 15)
            ['product_id' => 11, 'type' => 'Iced', 'value' => 'Regular', 'price' => 149],
            ['product_id' => 12, 'type' => 'Iced', 'value' => 'Regular', 'price' => 159],

            ['product_id' => 13, 'type' => 'Iced', 'value' => 'Regular', 'price' => 99],
            ['product_id' => 14, 'type' => 'Iced', 'value' => 'Regular', 'price' => 109],
            ['product_id' => 15, 'type' => 'Iced', 'value' => 'Regular', 'price' => 99],

            // Snacks (product_id 16 - 21)
            ['product_id' => 16, 'type' => 'Serving', 'value' => 'Regular', 'price' => 69],
            ['product_id' => 17, 'type' => 'Serving', 'value' => 'Regular', 'price' => 69],
            ['product_id' => 18, 'type' => 'Serving', 'value' => 'Regular', 'price' => 100],
            ['product_id' => 19, 'type' => 'Serving', 'value' => 'Regular', 'price' => 169],
            ['product_id' => 20, 'type' => 'Serving', 'value' => 'Regular', 'price' => 198],
            ['product_id' => 21, 'type' => 'Serving', 'value' => 'Regular', 'price' => 189],

            // Waffle (product_id 22 - 24)
            ['product_id' => 22, 'type' => 'Flavor', 'value' => 'Chocolate', 'price' => 79],
            ['product_id' => 23, 'type' => 'Flavor', 'value' => 'Caramel', 'price' => 79],
            ['product_id' => 24, 'type' => 'Flavor', 'value' => 'Strawberry', 'price' => 79],

            // Ramen (product_id 25)
            ['product_id' => 25, 'type' => 'Spice Level', 'value' => 'Mild', 'price' => 149],
            ['product_id' => 25, 'type' => 'Spice Level', 'value' => 'Spicy', 'price' => 149],
        ];

        // Insert product variations into the database
        foreach ($variations as $variation) {
            ProductVariation::create($variation);
        }

        $this->command->info('Product variations table seeded successfully!');
    }
}
