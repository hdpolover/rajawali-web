<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DefaultCustomerSeed extends Seeder
{
    public function run()
    {
        // create default customer
        $data = [
            'name' => 'John Doe',
            'phone' => '08123456789',
            'address' => 'Jl. Raya No. 123',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('customers')->insert($data);
    }
}
