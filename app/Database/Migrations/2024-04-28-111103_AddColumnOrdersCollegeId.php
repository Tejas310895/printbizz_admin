<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnOrdersCollegeId extends Migration
{
    public function up()
    {
        $fields = [
            'college_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
        ];
        $this->forge->addColumn('orders', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('orders', ['college_id']);
    }
}
