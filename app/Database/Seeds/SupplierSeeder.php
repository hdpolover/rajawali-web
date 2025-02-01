<?php

// app/Database/Seeds/AdminSeeder.php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SuppierSeeder extends Seeder
{

    public function run()
    {
        $suppliers = [
            [
                'name' => 'PT. Supplier 1',
                'phone_number' => '08123456789',
                'address' => 'Jl. Supplier 1 No. 1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'PT. Supplier 2',
                'phone_number' => '08123456789',
                'address' => 'Jl. Supplier 2 No. 2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Using Query Builder
        $this->db->table('suppliers')->insertBatch($suppliers);
    }
}