<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RenamePurchases extends Migration
{
    public function up()
    {
        // rename table purchase_transactions to purchases and purchase_transaction_details to purchase_details
        $this->forge->renameTable('purchase_transactions', 'purchases');
        $this->forge->renameTable('purchase_transaction_details', 'purchase_details');

        // rename foreign key
        // $fields = [
        //     'old_name' => [
        //         'name' => 'new_name',
        //         'type' => 'TEXT',
        //         'null' => false,
        //     ],
        // ];
        // $forge->modifyColumn('table_name', $fields);
        $fields = [
            'purchase_transaction_id' => [
                'name' => 'purchase_id',
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ];

        $this->forge->modifyColumn('purchase_details', $fields);
    }

    public function down()
    {
        // 
    }
}
