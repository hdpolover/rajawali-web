<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SlPaymentDetails extends Migration
{
    public function up()
    {
        // create table sale_payment_details
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'sale_payment_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'payment_method' => [
                'type' => 'ENUM',
                'constraint' => ['cash', 'card', 'transfer'],
            ],
            'amount' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'proof' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'default' => 'default.jpg',
            ],
            'payment_date' => [
                'type' => 'DATE',
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'completed', 'canceled'],
                'default' => 'pending',
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
        $this->forge->addForeignKey('sale_payment_id', 'sale_payments', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('sale_payment_details');
    }

    public function down()
    {
        // drop table sale_payment_details
        $this->forge->dropTable('sale_payment_details');
    }
}
