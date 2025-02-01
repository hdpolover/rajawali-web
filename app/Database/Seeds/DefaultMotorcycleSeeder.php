<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DefaultMotorcycleSeeder extends Seeder
{
    public function run()
    {
        // create default motorcycles data
        $data = [
            [
                'customer_id' => 1,
                'brand' => 'Honda',
                'model' => 'CBR1000RR',
                'license_number' => 'B 1234 ABC',
                // date time to now
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'customer_id' => 2,
                'brand' => 'Yamaha',
                'model' => 'YZF-R1',
                'license_number' => 'B 5678 DEF',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'customer_id' => 2,
                'brand' => 'Suzuki',
                'model' => 'GSX-R1000',
                'license_number' => 'B 9101 GHI',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Using Query Builder
        $this->db->table('motorcycles')->insertBatch($data);
    }
}
