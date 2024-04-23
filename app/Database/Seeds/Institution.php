<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Institution extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Diploma College',
                'status'    => '1',
                'created_by'    => '1',
                'updated_by'    => '1'
            ],
            [
                'name' => 'PUC College',
                'status'    => '1',
                'created_by'    => '1',
                'updated_by'    => '1'
            ]
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO institutions (name, status,created_by,updated_by) VALUES(:name:, :status:,:created_by:,:updated_by:)', $data);

        // Using Query Builder
        $this->db->table('institutions')->insertBatch($data);
    }
}
