<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AllSeeder extends Seeder
{
    public function run()
    {
        $this->call('Institution');
        $this->call('PartnerDetails');
        $this->call('ProductsItemnaryGroup');
        $this->call('ProductsItemnary');
        $this->call('Products');
    }
}
