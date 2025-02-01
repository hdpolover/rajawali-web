<?php
// app/Database/Seeds/MainSeeder.php

namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        // check if the table is empty, then only seed the data to the table

        // roles seeder
        if ($this->db->table('roles')->countAll() == 0) {
            $this->call('RolesSeeder');
        }

        // menu items seeder
        if ($this->db->table('menu_items')->countAll() == 0) {
            $this->call('MenuItemsSeeder');
        }

        // role menu items seeder
        if ($this->db->table('role_menu_items')->countAll() == 0) {
            $this->call('RoleMenuItemsSeeder');
        }

        // admin seeder
        if ($this->db->table('admins')->countAll() == 0) {
            $this->call('AdminSeeder');
        }

        // master data
        if ($this->db->table('spare_part_types')->countAll() == 0) {
            $this->call('SparePartTypeSeeder');
        }

        if ($this->db->table('spare_parts')->countAll() == 0) {
            $this->call('SparePartSeeder');
        }
    }
}