<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SparePartSaleDetails extends Migration
{
    public function up()
    {
        // create table spare_part_sale_details
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'spare_part_sale_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'spare_part_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'price' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'sub_total' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
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

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('spare_part_sale_id', 'spare_part_sales', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('spare_part_id', 'spare_parts', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('spare_part_sale_details');
    }

    public function down()
    {
        // drop table spare_part_sale_details
        $this->forge->dropTable('spare_part_sale_details');
    }
}
