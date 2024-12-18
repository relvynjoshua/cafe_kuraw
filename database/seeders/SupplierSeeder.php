<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample supplier data
        $suppliers = [
            [
                'company_name' => 'Coffee Beans Co.',
                'contact_person' => 'John Smith',
                'phone_number' => '09123456789',
                'email' => 'john@coffeebeansco.com',
                'address' => '123 Coffee Street, Cagayan de Oro, Philippines'
            ],
            [
                'company_name' => 'Bakery Essentials Inc.',
                'contact_person' => 'Jane Doe',
                'phone_number' => '09234567890',
                'email' => 'jane@bakeryessentials.com',
                'address' => '456 Pastry Lane, Manila, Philippines'
            ],
            [
                'company_name' => 'Kitchen Equipment Supply',
                'contact_person' => 'Mike Johnson',
                'phone_number' => '09345678901',
                'email' => 'mike@kitchensupply.com',
                'address' => '789 Kitchen Blvd, Cebu City, Philippines'
            ],
            [
                'company_name' => 'Fresh Dairy Farms',
                'contact_person' => 'Anna Cruz',
                'phone_number' => '09456789012',
                'email' => 'anna@freshdairyfarms.com',
                'address' => 'Farm Road 101, Batangas, Philippines'
            ],
            [
                'company_name' => 'Premium Packaging Solutions',
                'contact_person' => 'Sarah Lee',
                'phone_number' => '09567890123',
                'email' => 'sarah@packagingsolutions.com',
                'address' => '22 Packaging Way, Davao City, Philippines'
            ]
        ];

        // Insert suppliers into the database
        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }

        // Optional success message
        $this->command->info('Suppliers table seeded successfully!');
    }
}
