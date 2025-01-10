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
        // Updated supplier data
        $suppliers = [
            [
                'company_name' => 'Gaisano City Mall CDO',
                'contact_person' => 'John Smith',
                'phone_number' => '09123456789',
                'email' => 'john@coffeebeansco.com',
                'address' => 'Claro M. Recto Avenue, Cagayan de Oro, 9000 Misamis Oriental',
            ],
            [
                'company_name' => 'S&R Membership Shopping Cagayan de Oro',
                'contact_person' => 'Jane Doe',
                'phone_number' => '09234567890',
                'email' => 'jane@bakeryessentials.com',
                'address' => 'Kauswagan Highway, Cagayan de Oro City, 9000, Misamis Oriental',
            ],
            [
                'company_name' => 'Equilibrium Intertrade Corporation',
                'contact_person' => 'Mike Johnson',
                'phone_number' => '09345678901',
                'email' => 'mike@kitchensupply.com',
                'address' => '2nd Floor, Cagayan Town Center, Capt. Vicente Roa Street, Cagayan de Oro City',
            ],
            [
                'company_name' => 'All-About Baking',
                'contact_person' => 'Anna Cruz',
                'phone_number' => '09456789012',
                'email' => 'anna@freshdairyfarms.com',
                'address' => 'Limketkai Center, Cagayan de Oro City',
            ],
        ];

        // Insert suppliers into the database
        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }

        // Optional success message
        $this->command->info('Suppliers table truncated and seeded successfully with updated entries!');
    }
}
