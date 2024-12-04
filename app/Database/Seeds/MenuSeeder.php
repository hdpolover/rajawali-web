<?php
// app/Database/Seeds/MenuSeeder.php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $menuItems = [
            // Dashboard
            [
                'id' => 1,
                'parent_id' => null,
                'title' => 'Dashboard',
                'icon' => 'bi bi-grid-fill',
                'url' => 'dashboard',
                'order_position' => 1
            ],
            // Master Data
            [
                'id' => 2,
                'parent_id' => null,
                'title' => 'Master Data',
                'icon' => 'bi bi-database-fill',
                'url' => '#',
                'order_position' => 2
            ],
            [
                'id' => 3,
                'parent_id' => 2,
                'title' => 'Products',
                'icon' => '',
                'url' => 'products',
                'order_position' => 1
            ],
            [
                'id' => 4,
                'parent_id' => 2,
                'title' => 'Categories',
                'icon' => '',
                'url' => 'categories',
                'order_position' => 2
            ],
            [
                'id' => 5,
                'parent_id' => 2,
                'title' => 'Suppliers',
                'icon' => '',
                'url' => 'suppliers',
                'order_position' => 3
            ],
            [
                'id' => 6,
                'parent_id' => 2,
                'title' => 'Customers',
                'icon' => '',
                'url' => 'customers',
                'order_position' => 4
            ],
            // Transactions
            [
                'id' => 7,
                'parent_id' => null,
                'title' => 'Transactions',
                'icon' => 'bi bi-cart-fill',
                'url' => '#',
                'order_position' => 3
            ],
            [
                'id' => 8,
                'parent_id' => 7,
                'title' => 'Sales',
                'icon' => '',
                'url' => 'sales',
                'order_position' => 1
            ],
            [
                'id' => 9,
                'parent_id' => 7,
                'title' => 'Purchase',
                'icon' => '',
                'url' => 'purchase',
                'order_position' => 2
            ],
            // Reports
            [
                'id' => 10,
                'parent_id' => null,
                'title' => 'Reports',
                'icon' => 'bi bi-file-earmark-text-fill',
                'url' => '#',
                'order_position' => 4
            ],
            [
                'id' => 11,
                'parent_id' => 10,
                'title' => 'Sales Report',
                'icon' => '',
                'url' => 'reports/sales',
                'order_position' => 1
            ],
            [
                'id' => 12,
                'parent_id' => 10,
                'title' => 'Purchase Report',
                'icon' => '',
                'url' => 'reports/purchase',
                'order_position' => 2
            ],
            [
                'id' => 13,
                'parent_id' => 10,
                'title' => 'Stock Report',
                'icon' => '',
                'url' => 'reports/stock',
                'order_position' => 3
            ]
        ];
        
        // Inserting the menu items into the 'menu_items' table
        $this->db->table('menu_items')->insertBatch($menuItems);
    }
}
