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
                'address' => 'Claro M. Recto Avenue, Cagayan de Oro, 9000 Misamis Oriental',
            ],
            [
                'company_name' => 'S&R Membership Shopping Cagayan de Oro',
                'address' => 'Kauswagan Highway, Cagayan de Oro City, 9000, Misamis Oriental',
            ],
            [
                'company_name' => 'Equilibrium Intertrade Corporation',
                'address' => '2nd Floor, Cagayan Town Center, Capt. Vicente Roa Street, Cagayan de Oro City',
            ],
            [
                'company_name' => 'All-About Baking',
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
