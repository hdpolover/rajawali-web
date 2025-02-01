<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DefaultServicePriceSeeder extends Seeder
{
    public function run()
    {
        // create default service prices
        $data = [
            [
                'service_id' => 1,
                'price' => 100000,
                'effective_date' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'service_id' => 2,
                'price' => 200000,
                'effective_date' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'service_id' => 3,
                'price' => 300000,
                'effective_date' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('service_prices')->insertBatch($data);
    }
}
