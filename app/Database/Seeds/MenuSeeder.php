<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $timestamp = date('Y-m-d H:i:s');
        
        $menuItems = [
            // Dashboard
            [
                'id' => 1, 
                'parent_id' => null, 
                'title' => 'Dashboard', 
                'icon' => 'bi bi-grid-fill', 
                'url' => 'dashboard', 
                'order_position' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            
            // Transaksi
            [
                'id' => 2, 
                'parent_id' => null, 
                'title' => 'Transaksi', 
                'icon' => 'bi bi-cart-fill', 
                'url' => '#', 
                'order_position' => 2,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 3, 
                'parent_id' => 2, 
                'title' => 'Penjualan', 
                'icon' => null,
                'url' => 'transactions/sales', 
                'order_position' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 4, 
                'parent_id' => 2, 
                'title' => 'Barang Masuk', 
                'icon' => null,
                'url' => 'transactions/purchases', 
                'order_position' => 2,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            
            // Inventori
            [
                'id' => 5, 
                'parent_id' => null, 
                'title' => 'Inventori', 
                'icon' => 'bi bi-box-seam-fill', 
                'url' => '#', 
                'order_position' => 3,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 6, 
                'parent_id' => 5, 
                'title' => 'Spare Part', 
                'icon' => null,
                'url' => 'inventory/spareparts', 
                'order_position' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 7, 
                'parent_id' => 5, 
                'title' => 'Supplier', 
                'icon' => null,
                'url' => 'inventory/suppliers', 
                'order_position' => 2,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 8, 
                'parent_id' => 5, 
                'title' => 'Stock Management', 
                'icon' => null,
                'url' => 'inventory/stock', 
                'order_position' => 3,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            
            // Mekanik
            [
                'id' => 9, 
                'parent_id' => null, 
                'title' => 'Mekanik', 
                'icon' => 'bi bi-wrench-adjustable', 
                'url' => '#', 
                'order_position' => 4,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 10, 
                'parent_id' => 9, 
                'title' => 'Data Mekanik', 
                'icon' => null,
                'url' => 'mechanics', 
                'order_position' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 11, 
                'parent_id' => 9, 
                'title' => 'Layanan Service', 
                'icon' => null,
                'url' => 'mechanics/services', 
                'order_position' => 2,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 12, 
                'parent_id' => 9, 
                'title' => 'Penggajian', 
                'icon' => null,
                'url' => 'mechanics/payroll', 
                'order_position' => 3,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            
            // Customer
            [
                'id' => 13, 
                'parent_id' => null, 
                'title' => 'Customer', 
                'icon' => 'bi bi-people-fill', 
                'url' => '#', 
                'order_position' => 5,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 14, 
                'parent_id' => 13, 
                'title' => 'Data Pelanggan', 
                'icon' => null,
                'url' => 'customers', 
                'order_position' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 15, 
                'parent_id' => 13, 
                'title' => 'Data Motor', 
                'icon' => null,
                'url' => 'motorcycles', 
                'order_position' => 2,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            
            // Laporan
            [
                'id' => 16, 
                'parent_id' => null, 
                'title' => 'Laporan', 
                'icon' => 'bi bi-file-earmark-text-fill', 
                'url' => '#', 
                'order_position' => 6,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 17, 
                'parent_id' => 16, 
                'title' => 'Transaksi', 
                'icon' => null,
                'url' => 'reports/transactions', 
                'order_position' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 18, 
                'parent_id' => 16, 
                'title' => 'Inventori', 
                'icon' => null,
                'url' => 'reports/inventory', 
                'order_position' => 2,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 19, 
                'parent_id' => 16, 
                'title' => 'Kinerja Mekanik', 
                'icon' => null,
                'url' => 'reports/mechanics', 
                'order_position' => 3,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 20, 
                'parent_id' => 16, 
                'title' => 'Statistik Penjualan', 
                'icon' => null,
                'url' => 'reports/sales', 
                'order_position' => 4,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            
            // Pengaturan
            [
                'id' => 21, 
                'parent_id' => null, 
                'title' => 'Pengaturan', 
                'icon' => 'bi bi-gear-fill', 
                'url' => '#', 
                'order_position' => 7,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 22, 
                'parent_id' => 21, 
                'title' => 'Admin', 
                'icon' => null,
                'url' => 'settings/admins', 
                'order_position' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 23, 
                'parent_id' => 21, 
                'title' => 'Konfigurasi Sistem', 
                'icon' => null,
                'url' => 'settings/system', 
                'order_position' => 2,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 24, 
                'parent_id' => 21, 
                'title' => 'Log Aktivitas', 
                'icon' => null,
                'url' => 'settings/logs', 
                'order_position' => 3,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]
        ];
        
        $this->db->table('menu_items')->insertBatch($menuItems);
    }
}