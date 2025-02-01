<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DefaultServiceSeeder extends Seeder
{
    public function run()
    {
        // create default services
        $data = [
            [
                'name' => 'Service A',
                'description' => 'Service A description',
                'difficulty' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Service B',
                'description' => 'Service B description',
                'difficulty' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Service C',
                'description' => 'Service C description',
                'difficulty' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('services')->insertBatch($data);
    }
}
