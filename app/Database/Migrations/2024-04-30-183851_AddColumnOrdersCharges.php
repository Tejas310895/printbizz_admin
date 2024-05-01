<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnOrdersCharges extends Migration
{
    public function up()
    {
        $fields = [
            'charges' => [
                'type' => 'JSON',
            ],
        ];
        $this->forge->addColumn('orders', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('orders', ['charges']);
    }
}
