<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductsItemnary extends Seeder
{
    public function run()
    {
        $data = [
            [
                'item_group_id' => 1,
                'name' => 'A4 Size',
                'price' => 0,
                'status'    => '1',
                'created_by'    => '1',
                'updated_by'    => '1'
            ],
            [
                'item_group_id' => 1,
                'name' => 'Letter Size',
                'price' => 1,
                'status'    => '1',
                'created_by'    => '1',
                'updated_by'    => '1'
            ],
            [
                'item_group_id' => 2,
                'name' => 'Black & White',
                'price' => 0,
                'status'    => '1',
                'created_by'    => '1',
                'updated_by'    => '1'
            ],
            [
                'item_group_id' => 2,
                'name' => 'Color Print',
                'price' => 3,
                'status'    => '1',
                'created_by'    => '1',
                'updated_by'    => '1'
            ],
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO institutions (name, status,created_by,updated_by) VALUES(:name:, :status:,:created_by:,:updated_by:)', $data);

        // Using Query Builder
        $this->db->table('products_itemnary')->insertBatch($data);
    }
}
