<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AddSparePartTypeMenuItemToMenus extends Seeder
{
    public function run()
    {
        // add spare part type menu item
        $data = [
            [
                'id' => 24,
                'parent_id' => 3,
                'order_position' => 7,
                'title' => 'Tipe Spare Part',
                'url' => 'spare-part-types',
                'icon' => 'fa-cogs',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Using Query Builder
        $this->db->table('menu_items')->insertBatch($data);
    }
}
