<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MechanicSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Mike Brown',
                'phone_number' => '1234567890',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Sara White',
                'phone_number' => '0987654321',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Tom Black',
                'phone_number' => '1122334455',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('mechanics')->insertBatch($data);
    }
}