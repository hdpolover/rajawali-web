<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SparePartDetails extends Migration
{
    public function up()
    {
        // Spare Part Details
        // id (Primary Key)
        // spare_part_id (Foreign Key -> Spare Parts.id)
        // current_stock (INTEGER)
        // current_sell_price (DECIMAL)
        // current_buy_price (DECIMAL)
        // created_at (TIMESTAMP)
        // updated_at (TIMESTAMP)
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'spare_part_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'current_stock' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => true,
            ],
            'current_sell_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,

            ],
            'current_buy_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,

            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,

            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,

            ],
            'deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,

            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('spare_part_id', 'spare_parts', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('spare_part_details');
    }

    public function down()
    {
        // Drop table 'spare_part_details' if it exists
        $this->forge->dropTable('spare_part_details');
    }
}
