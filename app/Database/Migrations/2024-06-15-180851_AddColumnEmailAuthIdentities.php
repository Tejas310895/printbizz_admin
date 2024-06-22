<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnEmailAuthIdentities extends Migration
{
    public function up()
    {
        $fields = [
            'email' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null' => true
            ],
        ];
        $this->forge->addColumn('auth_identities', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('auth_identities', ['email']);
    }
}
