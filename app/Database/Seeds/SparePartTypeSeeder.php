<?php

// app/Database/Seeds/SparePartTypeSeeder.php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SparePartTypeSeeder extends Seeder
{
    public function run()
    {
        $sparePartTypes = [
            [
                'name' => 'Ban',
                'description' => 'Spare Part Ban',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Oli',
                'description' => 'Spare Part Oli',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Using Query Builder
        $this->db->table('spare_part_types')->insertBatch($sparePartTypes);
    }
}