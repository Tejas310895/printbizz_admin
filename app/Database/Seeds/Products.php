<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Products extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'A4 Size',
                'default_price' => 1,
                'itemnary' => json_encode([1, 2]),
                'img' => json_encode(['https://i.ibb.co/rxJtTz4/copier.png']),
                'status'    => '1',
                'created_by'    => '1',
                'updated_by'    => '1'
            ],
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO institutions (name, status,created_by,updated_by) VALUES(:name:, :status:,:created_by:,:updated_by:)', $data);

        // Using Query Builder
        $this->db->table('products')->insertBatch($data);
    }
}
