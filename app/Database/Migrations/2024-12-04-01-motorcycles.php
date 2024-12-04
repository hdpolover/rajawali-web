<?php

// app/Database/Migrations/2024-12-04-000006_Motorcycles.php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Motorcycles extends Migration
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
            'customer_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'make' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'model' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'year' => [
                'type' => 'YEAR',
                'null' => true
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
        $this->forge->addForeignKey('customer_id', 'customers', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('motorcycles');
    }

    public function down()
    {
        $this->forge->dropTable('motorcycles');
    }
}
