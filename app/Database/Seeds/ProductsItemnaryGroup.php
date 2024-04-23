<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductsItemnaryGroup extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Paper Type',
                'type' => 1,
                'status'    => '1',
                'created_by'    => '1',
                'updated_by'    => '1'
            ],
            [
                'name' => 'Color',
                'type' => 2,
                'status'    => '1',
                'created_by'    => '1',
                'updated_by'    => '1'
            ]
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO institutions (name, status,created_by,updated_by) VALUES(:name:, :status:,:created_by:,:updated_by:)', $data);

        // Using Query Builder
        $this->db->table('products_itemnary_group')->insertBatch($data);
    }
}
