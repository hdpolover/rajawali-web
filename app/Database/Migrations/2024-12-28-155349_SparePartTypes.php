<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SparePartTypes extends Migration
{
    public function up()
    {
        // id, name, description, created_at, updated_at, deleted_at
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        // $this->forge->addPrimaryKey('id');
        // $this->forge->createTable('spare_part_types');
    }

    public function down()
    {
        $this->forge->dropTable('spare_part_types');
    }
}
