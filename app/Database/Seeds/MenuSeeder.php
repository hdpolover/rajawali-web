<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $timestamp = date('Y-m-d H:i:s');
        
        // 1. Dashboard
        // Label: Dashboard
        // Description: Beranda utama untuk ringkasan data dan statistik penting.
        // 2. Transaksi
        // Label: Transaksi
        // Submenus:
        // Penjualan: Kelola transaksi pelanggan, seperti tambah, edit, dan hapus.
        // Barang Masuk: Kelola transaksi barang masuk dari supplier.
        // Barang Return: Kelola barang yang dikembalikan ke supplier.
        // 3. Master Data
        // Label: Master Data
        // Submenus:
        // Spare Part: Kelola stok dan detail suku cadang.
        // Supplier: Kelola data supplier.
        // Servis: Kelola jenis layanan untuk pelanggan.
        // Mekanik: Kelola data mekanik.
        // Pelanggan: Kelola data pelanggan.
        // Motor: Kelola data motor pelanggan yang terhubung dengan data pelanggan.
        // 4. Notifikasi & Aktivitas Admin
        // Label: Notifikasi & Aktivitas Admin
        // Description:
        // Notifikasi: Kelola pemberitahuan terkait stok rendah, servis mendekati deadline, atau pengingat pembayaran.
        // Aktivitas Admin: Pantau log aktivitas semua admin untuk audit dan keamanan.
        // 5. Laporan
        // Label: Laporan
        // Description: Lihat dan unduh laporan transaksi, stok, dan performa bisnis.
        // 6. Pengaturan & Akses
        // Label: Pengaturan & Akses
        // Submenus:
        // Pengaturan Website: Atur pengaturan dasar website.
        // Pengaturan Gaji Mekanik: Kelola gaji mekanik.
        // Admin: Kelola data admin.
        // Menu: Kelola struktur menu di aplikasi.
        // Roles: Kelola hak akses dan peran admin.

        // id
// parent_id
// title
// icon
// url
// order_position
// created_at
// updated_at

        // specify id and parent id should be null for main menu items
        $menuItems = [
            [
                'id' => 1,
                'parent_id' => null,
                'title' => 'Dashboard',
                'icon' => 'fa-tachometer-alt',
                'url' => 'dashboard',
                'order_position' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 2,
                'parent_id' => null,
                'title' => 'Transaksi',
                'icon' => 'fa-cash-register',
                'url' => '#',
                'order_position' => 2,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 3,
                'parent_id' => null,
                'title' => 'Master Data',
                'icon' => 'fa-database',
                'url' => '#',
                'order_position' => 3,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 4,
                'parent_id' => null,
                'title' => 'Notifikasi & Aktivitas Admin',
                'icon' => 'fa-bell',
                'url' => '#',
                'order_position' => 4,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 5,
                'parent_id' => null,
                'title' => 'Laporan',
                'icon' => 'fa-file-alt',
                'url' => '#',
                'order_position' => 5,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 6,
                'parent_id' => null,
                'title' => 'Pengaturan & Akses',
                'icon' => 'fa-cogs',
                'url' => '#',
                'order_position' => 6,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 7,
                'parent_id' => 2,
                'title' => 'Penjualan',
                'icon' => 'fa-shopping-cart',
                'url' => 'transactions/sales',
                'order_position' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 8,
                'parent_id' => 2,
                'title' => 'Barang Masuk',
                'icon' => 'fa-truck',
                'url' => 'transactions/purchases',
                'order_position' => 2,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 9,
                'parent_id' => 2,
                'title' => 'Barang Return',
                'icon' => 'fa-undo',
                'url' => 'transactions/returns',
                'order_position' => 3,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 10,
                'parent_id' => 3,
                'title' => 'Spare Part',
                'icon' => 'fa-tools',
                'url' => 'spare-parts',
                'order_position' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 11,
                'parent_id' => 3,
                'title' => 'Supplier',
                'icon' => 'fa-truck',
                'url' => 'suppliers',
                'order_position' => 2,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 12,
                'parent_id' => 3,
                'title' => 'Servis',
                'icon' => 'fa-wrench',
                'url' => 'services',
                'order_position' => 3,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 13,
                'parent_id' => 3,
                'title' => 'Mekanik',
                'icon' => 'fa-user',
                'url' => 'mechanics',
                'order_position' => 4,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 14,
                'parent_id' => 3,
                'title' => 'Pelanggan',
                'icon' => 'fa-users',
                'url' => 'customers',
                'order_position' => 5,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 15,
                'parent_id' => 3,
                'title' => 'Motor',
                'icon' => 'fa-motorcycle',
                'url' => 'motorcycles',
                'order_position' => 6,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 16,
                'parent_id' => 4,
                'title' => 'Notifikasi',
                'icon' => 'fa-bell',
                'url' => 'notifications',
                'order_position' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 17,
                'parent_id' => 4,
                'title' => 'Aktivitas Admin',
                'icon' => 'fa-history',
                'url' => 'activity-logs',
                'order_position' => 2,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
           // laporan is just a single menu like written above
            [
                'id' => 18,
                'parent_id' => 5,
                'title' => 'Laporan',
                'icon' => 'fa-file-alt',
                'url' => 'reports',
                'order_position' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 19,
                'parent_id' => 6,
                'title' => 'Pengaturan Website',
                'icon' => 'fa-globe',
                'url' => 'settings',
                'order_position' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 20,
                'parent_id' => 6,
                'title' => 'Pengaturan Gaji Mekanik',
                'icon' => 'fa-money-bill-wave',
                'url' => 'mechanic-salaries',
                'order_position' => 2,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 21,
                'parent_id' => 6,
                'title' => 'Admin',
                'icon' => 'fa-user-shield',
                'url' => 'admins',
                'order_position' => 3,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 22,
                'parent_id' => 6,
                'title' => 'Menu',
                'icon' => 'fa-bars',
                'url' => 'menus',
                'order_position' => 4,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'id' => 23,
                'parent_id' => 6,
                'title' => 'Roles',
                'icon' => 'fa-user-tag',
                'url' => 'roles',
                'order_position' => 5,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
        ];
        
        $this->db->table('menu_items')->insertBatch($menuItems);
    }
}