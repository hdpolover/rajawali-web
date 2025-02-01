<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AddSparePartTypeMenuItemToRoleMenuItems extends Seeder
{
    public function run()
    {
        // add spare part type menu item to role menu items
        $data = [
            [
                'role_id' => 1,
                'menu_item_id' => 24,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Using Query Builder
        $this->db->table('role_menu_items')->insertBatch($data);
    }
}
