<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnOrders extends Migration
{
    public function up()
    {
        $fields = [
            'discount' => [
                'type'           => 'JSON',
                'null' => true,
            ],
        ];
        $this->forge->addColumn('orders', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('orders', ['discount']);
    }
}
