<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class ProductItemnaryGroup extends Migration
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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'type' => [
                'type' => 'INT',
                'constraint' => '100',
                'null' => true,
            ],
            'icons' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'status' => [
                'type' => 'INT',
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
        $this->forge->createTable('products_itemnary_group');
    }

    public function down()
    {
        $this->forge->dropTable('products_itemnary_group');
    }
}
