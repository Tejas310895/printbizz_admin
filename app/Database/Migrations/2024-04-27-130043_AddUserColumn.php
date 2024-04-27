<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserColumn extends Migration
{
    public function up()
    {
        $fields = [
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
        ];
        $this->forge->addColumn('orders', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('orders', ['user_id']);
    }
}
