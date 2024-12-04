<?php

// app/Database/Migrations/2024-12-04-000002_MenuItems.php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MenuItems extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'parent_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'icon' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'order_position' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('parent_id', 'menu_items', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('menu_items');
    }

    public function down()
    {
        $this->forge->dropTable('menu_items');
    }
}
