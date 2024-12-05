<?php
// app/Database/Seeds/RoleMenuItemsSeeder.php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
class RoleMenuItemsSeeder extends Seeder
{
    public function run()
    {
        $roleMenuItems = [];
        $timestamp = date('Y-m-d H:i:s');
        
        // Owner - Full Access (ID: 1-24)
        for ($i = 1; $i <= 24; $i++) {
            $roleMenuItems[] = [
                'role_id' => 1,
                'menu_item_id' => $i,
                'created_at' => $timestamp
            ];
        }
        
        // Kasir Access
        $kasirMenus = [1, 2, 3, 13, 14, 15]; // Dashboard, Transaksi(Sales), Customer
        foreach ($kasirMenus as $menuId) {
            $roleMenuItems[] = [
                'role_id' => 2,
                'menu_item_id' => $menuId,
                'created_at' => $timestamp
            ];
        }
        
        // Gudang Access
        $gudangMenus = [1, 5, 6, 7, 8]; // Dashboard, Inventori
        foreach ($gudangMenus as $menuId) {
            $roleMenuItems[] = [
                'role_id' => 3,
                'menu_item_id' => $menuId,
                'created_at' => $timestamp
            ];
        }
        
        $this->db->table('role_menu_items')->insertBatch($roleMenuItems);
    }
}