<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear all existing records in the suppliers table
        Supplier::truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Updated supplier data with only 'company_name' and 'address'
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
        $this->command->info('Suppliers table truncated and seeded successfully with company_name and address only!');
    }
}
