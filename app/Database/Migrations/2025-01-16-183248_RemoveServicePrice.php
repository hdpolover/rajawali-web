<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveServicePrice extends Migration
{
    public function up()
    {
        // remove column service_price from services table
        $this->forge->dropColumn('services', 'price');
    }

    public function down()
    {
        //
    }
}
