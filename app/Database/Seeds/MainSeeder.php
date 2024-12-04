<?php
// app/Database/Seeds/MainSeeder.php

namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        $this->call('RolesSeeder');
        $this->call('MenuSeeder');
        $this->call('RoleMenuItemsSeeder');
        $this->call('AdminSeeder');
    }
}