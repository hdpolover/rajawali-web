<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DefaultMechanicSeeder extends Seeder
{
    public function run()
    {
        // create default mechanic
        $data = [
            'name' => 'Mechanic 1',
            'phone' => '08123456789',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('mechanics')->insert($data);
    }
}
