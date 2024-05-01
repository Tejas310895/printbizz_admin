<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnOrdersPartnerId extends Migration
{
    public function up()
    {
        $fields = [
            'partner_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
        ];
        $this->forge->addColumn('orders', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('orders', ['partner_id']);
    }
}
