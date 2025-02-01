<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMerkSparePart extends Migration
{
    public function up()
    {
        // add merk column
        $this->forge->addColumn('spare_parts', [
            'merk' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'name'
            ]
        ]);
    }

    public function down()
    {
        // drop merk column
        $this->forge->dropColumn('spare_parts', 'merk');
    }
}
