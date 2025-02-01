<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PurchaseTransactionDetails extends Migration
{
    public function up()
    {
        // fields
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'purchase_transaction_id' => [
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
                'unsigned' => true,
            ],
            // buy price, sell price, and sub total price
            'buy_price' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'null' => true,
            ],
            'sell_price' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'null' => true,
            ],
            'sub_total' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
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

        // add primary key
        $this->forge->addKey('id', true );

        // add foreign key
        $this->forge->addForeignKey('purchase_transaction_id', 'purchase_transactions', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('spare_part_id', 'spare_parts', 'id', 'CASCADE', 'CASCADE');

        // create table
        $this->forge->createTable('purchase_transaction_details');
    }

    public function down()
    {
        // drop table
        $this->forge->dropTable('purchase_transaction_details');
    }
}
