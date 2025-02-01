<?php

// app/Database/Seeds/AdminSeeder.php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SparePartSeeder extends Seeder
{
    
        public function run()
        {
            $spareParts = [
                [
                    'name' => 'Spare Part 1',
                    'photo' => 'ban.jpg',
                    'code_number' => 'SP001',
                    'description' => 'Spare Part 1 Description',
                    'spare_part_type_id' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Spare Part 2',
                    'photo' => 'oli.jpg',
                    'code_number' => 'SP002',
                    'description' => 'Spare Part 2 Description',
                    'spare_part_type_id' => 2,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ];
    
            // Using Query Builder
            $this->db->table('spare_parts')->insertBatch($spareParts);
        }
    }