<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Settings extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'images',
                'parameters' => json_encode([
                    1 => 'http://localhost/printslug/user/public/assets/images/banner.png'
                ]),
            ],
            [
                'name' => 'charges',
                'parameters' => json_encode([
                    'del_charge' => 30,
                    'gst' => 5,
                    'limit' => 100
                ]),
            ],
            [
                'name' => 'gateway',
                'parameters' => json_encode([
                    'sms' => 1,
                    'payment' => 1
                ]),
            ],
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO institutions (name, status,created_by,updated_by) VALUES(:name:, :status:,:created_by:,:updated_by:)', $data);

        // Using Query Builder
        $this->db->table('app_settings')->insertBatch($data);
    }
}
