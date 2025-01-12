<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // List of products categorized
        $products = [
            // Espresso-Based Coffee
            ['name' => 'Espresso', 'category_id' => 1, 'description' => 'Rich and strong espresso shot.', 'price' => 80.00, 'image' => 'assets/img/menu/espresso.PNG'],
            ['name' => 'Café Americano', 'category_id' => 1, 'description' => 'Smooth and bold coffee.', 'price' => 90.00, 'image' => 'assets/img/menu/icedamericano.jpg'],
            ['name' => 'Cappuccino', 'category_id' => 1, 'description' => 'Espresso with steamed milk foam.', 'price' => 135.00, 'image' => 'assets/img/menu/icedcaramelm.jpg'],
            ['name' => 'Caramel Macchiato', 'category_id' => 1, 'description' => 'Caramel macchiato served hot or cold.', 'price' => 150.00, 'image' => 'assets/img/menu/icedcaramelm.jpg'],
            ['name' => 'Spanish Latte', 'category_id' => 1, 'description' => 'Sweet and creamy Spanish latte.', 'price' => 145.00, 'image' => 'assets/img/menu/icedspanishlatte.jpg'],
            ['name' => 'Dirty Matcha', 'category_id' => 1, 'description' => 'Matcha latte with espresso.', 'price' => 150.00, 'image' => 'assets/img/menu/iceddirtymatcha.jpg'],
            ['name' => 'Mocha Latte', 'category_id' => 1, 'description' => 'Rich mocha with espresso and chocolate.', 'price' => 130.00, 'image' => 'assets/img/menu/mochalatte.jpg'],

            // Milk Tea
            ['name' => 'Chocolate Milk Tea', 'category_id' => 2, 'description' => 'Chocolate milk tea blend.', 'price' => 59.00, 'image' => 'assets/img/menu/chocomt.jpg'],
            ['name' => 'Matcha Milk Tea', 'category_id' => 2, 'description' => 'Creamy matcha iced tea.', 'price' => 59.00, 'image' => 'assets/img/menu/matchamt.jpg'],
            ['name' => 'Wintermelon Milk Tea', 'category_id' => 2, 'description' => 'Wintermelon iced tea.', 'price' => 59.00, 'image' => 'assets/img/menu/wintermelonmt.jpg'],

            // Non-Coffee
            ['name' => 'Dark Chocolate Latte', 'category_id' => 3, 'description' => 'Iced dark chocolate drink.', 'price' => 149.00, 'image' => 'assets/img/menu/darckchoco.jpg'],
            ['name' => 'Strawberry Latte', 'category_id' => 3, 'description' => 'Refreshing strawberry latte.', 'price' => 159.00, 'image' => 'assets/img/menu/strawberrylatte.jpg'],
            ['name' => 'Green Apple-Lemon', 'category_id' => 3, 'description' => 'Green apple with a citrus twist.', 'price' => 99.00, 'image' => 'assets/img/menu/greenapple.jpg'],
            ['name' => 'Mixed Berries', 'category_id' => 3, 'description' => 'Fruity drink with a berry mix.', 'price' => 109.00, 'image' => 'assets/img/menu/mixedberries.jpg'],
            ['name' => 'Raspberry-Sour Candy', 'category_id' => 3, 'description' => 'Raspberry iced drink with a sour twist.', 'price' => 99.00, 'image' => 'assets/img/menu/raspberry.jpg'],

            // Snacks
            ['name' => 'Banana Cream with Cheese', 'category_id' => 4, 'description' => 'Delicious banana cream dessert.', 'price' => 69.00, 'image' => 'assets/img/menu/bananacream.jpg'],
            ['name' => 'Chocolate-Coffee Pudding', 'category_id' => 4, 'description' => 'Rich pudding with a hint of coffee.', 'price' => 69.00, 'image' => 'assets/img/menu/chocolatecoffeepudding.jpg'],
            ['name' => 'Toasted Garlic Bread', 'category_id' => 4, 'description' => 'Crispy garlic-flavored bread.', 'price' => 100.00, 'image' => 'assets/img/menu/garlicbread.jpg'],
            ['name' => 'Beef Nachos', 'category_id' => 4, 'description' => 'Crispy nachos with cheese topping.', 'price' => 169.00, 'image' => 'assets/img/menu/nachos.jpg'],
            ['name' => 'Pizza (White Sauce Hawaiian)', 'category_id' => 4, 'description' => 'White sauce pizza with pineapple and ham.', 'price' => 198.00, 'image' => 'assets/img/menu/pizza.jpg'],
            ['name' => 'Clubhouse Sandwich', 'category_id' => 4, 'description' => 'Classic clubhouse sandwich.', 'price' => 189.00, 'image' => 'assets/img/menu/clubhouse.jpg'],

            // Waffle
            ['name' => 'Hersheys Chocolate Waffle', 'category_id' => 5, 'description' => 'Chocolate-filled waffle.', 'price' => 79.00, 'image' => 'assets/img/menu/chocolatewaffle.jpg'],
            ['name' => 'Hersheys Caramel Waffle', 'category_id' => 5, 'description' => 'Crispy caramel-topped waffle.', 'price' => 79.00, 'image' => 'assets/img/menu/caramelwaffle.jpg'],
            ['name' => 'Hersheys Strawberry Waffle', 'category_id' => 5, 'description' => 'Waffle with strawberry topping.', 'price' => 79.00, 'image' => 'assets/img/menu/strawberrywaffle.jpg'],

            // Ramen
            ['name' => 'Ku-Ramen', 'category_id' => 6, 'description' => 'Hot ramen bowl with flavorful broth.', 'price' => 149.00, 'image' => 'assets/img/menu/ramen.jpg'],
        ];

        // Insert products into the database
        foreach ($products as $product) {
            Product::create($product);
        }

        $this->command->info('Products table seeded successfully!');
    }
}
