<?php

// app/Database/Migrations/2024-12-04-000003_RoleMenuItems.php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RoleMenuItems extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'role_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'menu_item_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);
        $this->forge->addPrimaryKey(['role_id', 'menu_item_id']);
        $this->forge->addForeignKey('role_id', 'roles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('menu_item_id', 'menu_items', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('role_menu_items');
    }

    public function down()
    {
        $this->forge->dropTable('role_menu_items');
    }
}
