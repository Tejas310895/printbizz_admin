<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PartnerDetails extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id' => 2,
                'status'    => '1',
                'bank_details'    => json_encode([
                    'bank_name' => 'Axis Bank',
                    'account_number' => '457878545878545',
                    'ifsc_code' => 'UTIB000256',
                ]),
                'college_assigned_id'    => json_encode([1, 2]),
                'gst_details'    => json_encode([
                    'name' => 'ABC ENTERPRISES',
                    'gst_number' => 'ghfg454854545gh',
                    'pan_number' => 'GHGFG454kj',
                    'sate_code' => '27',
                    'address' => 'Vashi plaza near flyover',
                    'pincode' => '421701'
                ]),
                'created_by'    => '1',
                'updated_by'    => '1'
            ],
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO institutions (name, status,created_by,updated_by) VALUES(:name:, :status:,:created_by:,:updated_by:)', $data);

        // Using Query Builder
        $this->db->table('partner_details')->insertBatch($data);
    }
}
