<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class PartnerDetails extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
            'status' => [
                'type' => 'INT',
                'constraint' => '100',
                'null' => true,
            ],
            'bank_details' => [
                'type' => 'JSON',
            ],
            'college_assigned_id' => [
                'type' => 'JSON',
            ],
            'gst_details' => [
                'type' => 'JSON',
            ],
            'lat_long' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'created_by' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => true,
            ],
            'updated_by' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => true,
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'deleted_at' => [
                'type'    => 'TIMESTAMP',
                'null' => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('partner_details');
    }

    public function down()
    {
        $this->forge->dropTable('partner_details');
    }
}
