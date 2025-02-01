<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PurchasePaymentDetails extends Migration
{
    public function up()
    {
        // create table purchase_payment_details
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'purchase_payment_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'payment_type' => [
                'type' => 'ENUM',
                'constraint' => ['cash', 'transfer'],
                'default' => 'cash',
            ],
            // status
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['paid', 'unpaid'],
                'default' => 'paid',
            ],
            // proof of payment
            'proof' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'default' => 'default.jpg',
            ],
            'payment_date' => [
                'type' => 'DATE',
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

        $this->forge->addKey('id', true );
        $this->forge->addForeignKey('purchase_payment_id', 'purchase_payments', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('purchase_payment_details');
    }

    public function down()
    {
        // drop table purchase_payment_details
        $this->forge->dropTable('purchase_payment_details');
    }
}
