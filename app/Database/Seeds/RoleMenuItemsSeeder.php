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
        
        // Owner - Full Access (ID: 1-23)
        for ($i = 1; $i <= 23; $i++) {
            $roleMenuItems[] = [
            'role_id' => 1,
            'menu_item_id' => $i,
            'created_at' => $timestamp,
            'updated_at' => $timestamp
            ];
        }
        
        // Kasir Access
        $kasirMenus = [1, 2, 7, 8, 9]; // Dashboard, Transaksi(Penjualan, Barang Masuk, Barang Return)
        foreach ($kasirMenus as $menuId) {
            $roleMenuItems[] = [
            'role_id' => 2,
            'menu_item_id' => $menuId,
            'created_at' => $timestamp,
            'updated_at' => $timestamp
            ];
        }
        
        // Gudang Access
        $gudangMenus = [1, 2, 8, 9, 10, 11]; // Dashboard, Transaksi(Barang Masuk, Barang Return), Spare Part, Supplier
        foreach ($gudangMenus as $menuId) {
            $roleMenuItems[] = [
            'role_id' => 3,
            'menu_item_id' => $menuId,
            'created_at' => $timestamp,
            'updated_at' => $timestamp
            ];
        }
        
        $this->db->table('role_menu_items')->insertBatch($roleMenuItems);
    }
}