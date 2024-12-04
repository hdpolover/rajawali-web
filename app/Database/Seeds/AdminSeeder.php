<?php

// app/Database/Seeds/AdminSeeder.php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $admins = [
            // Admin for Owner role
            [
                'id' => 1,
                'role_id' => 1, // Owner
                'username' => 'owner', // Username for Owner
                'email' => 'owner@example.com',
                'password' => password_hash('ownerpassword', PASSWORD_BCRYPT), // Set your password here
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // Admin for Kasir role
            [
                'id' => 2,
                'role_id' => 2, // Kasir
                'username' => 'kasir', // Username for Kasir
                'email' => 'kasir@example.com',
                'password' => password_hash('kasirpassword', PASSWORD_BCRYPT), // Set your password here
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // Admin for Gudang role
            [
                'id' => 3,
                'role_id' => 3, // Gudang
                'username' => 'gudang', // Username for Gudang
                'email' => 'gudang@example.com',
                'password' => password_hash('gudangpassword', PASSWORD_BCRYPT), // Set your password here
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert data into admins table
        $this->db->table('admins')->insertBatch($admins);
    }
}
