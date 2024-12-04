<?php
// app/Database/Seeds/RoleMenuItemsSeeder.php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleMenuItemsSeeder extends Seeder
{
    public function run()
    {
        $roleMenuItems = [
            // Assigning menu items to Owner (id 1)
            [
                'role_id' => 1,
                'menu_item_id' => 1, // Dashboard
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => 1,
                'menu_item_id' => 2, // Master Data
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => 1,
                'menu_item_id' => 3, // Products
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => 1,
                'menu_item_id' => 4, // Categories
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => 1,
                'menu_item_id' => 5, // Suppliers
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => 1,
                'menu_item_id' => 6, // Customers
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => 1,
                'menu_item_id' => 7, // Transactions
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => 1,
                'menu_item_id' => 8, // Sales
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => 1,
                'menu_item_id' => 9, // Purchase
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => 1,
                'menu_item_id' => 10, // Reports
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => 1,
                'menu_item_id' => 11, // Sales Report
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => 1,
                'menu_item_id' => 12, // Purchase Report
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => 1,
                'menu_item_id' => 13, // Stock Report
                'created_at' => date('Y-m-d H:i:s'),
            ],

            // Assigning menu items to Kasir (id 2)
            [
                'role_id' => 2,
                'menu_item_id' => 1, // Dashboard
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => 2,
                'menu_item_id' => 7, // Transactions
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => 2,
                'menu_item_id' => 8, // Sales
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => 2,
                'menu_item_id' => 9, // Purchase
                'created_at' => date('Y-m-d H:i:s'),
            ],

            // Assigning menu items to Gudang (id 3)
            [
                'role_id' => 3,
                'menu_item_id' => 1, // Dashboard
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => 3,
                'menu_item_id' => 2, // Master Data
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => 3,
                'menu_item_id' => 3, // Products
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => 3,
                'menu_item_id' => 4, // Categories
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => 3,
                'menu_item_id' => 5, // Suppliers
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => 3,
                'menu_item_id' => 6, // Customers
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => 3,
                'menu_item_id' => 13, // Stock Report
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert data into role_menu_items table
        $this->db->table('role_menu_items')->insertBatch($roleMenuItems);
    }
}
