<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SparePartPriceHistory extends Migration
{
    public function up()
    {
        // Spare Part Price History
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
            'old_sell_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,

            ],
            'new_sell_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,

            ],
            'old_buy_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,

            ],
            'new_buy_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,

            ],
            'change_date' => [
                'type' => 'DATE',
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
        $this->forge->createTable('spare_part_price_history');
    }

    public function down()
    {
        // Drop table 'spare_part_price_history' if it exists
        $this->forge->dropTable('spare_part_price_history');
    }
}
