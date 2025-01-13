<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GalleryItem;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Example data for the gallery
        $galleryItems = [
            [
                'title' => 'Great Prices',
                'description' => 'Great promos with great prices',
                'category' => 'Food',
                'image' => 'assets/img/news/snackcombo.jpg',
                'slug' => 'great-prices',
            ],
            [
                'title' => 'Amazing Customers',
                'description' => 'Amazing customers eating at the shop today!',
                'category' => 'Customers',
                'image' => 'assets/img/gallery/moments/2.jpg',
                'slug' => 'amazing-customers',
            ],
            [
                'title' => 'Welcome to Kuraw Coffee Shop!',
                'description' => 'Successful opening of our coffee shop!',
                'category' => 'Store',
                'image' => 'assets/img/news/open.jpg',
                'slug' => 'welcome-kuraw',
            ],
        ];

        // Insert data into the gallery_items table
        foreach ($galleryItems as $item) {
            GalleryItem::create($item);
        }

        $this->command->info('Gallery items seeded successfully!');
    }
}
