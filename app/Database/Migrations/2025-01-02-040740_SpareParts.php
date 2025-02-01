<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SpareParts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'spare_part_type_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                // name must be unique
                'unique'     => true,
            ],
            'description' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'photo' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            // code number
            'code_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'deleted_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],  
        ]);
        
        // $this->forge->addKey('id', true);
        // $this->forge->addForeignKey('spare_part_type_id', 'spare_part_types', 'id', 'CASCADE', 'CASCADE');
        // $this->forge->createTable('spare_parts');
    }

    public function down()
    {
        $this->forge->dropTable('spare_parts');
    }
}