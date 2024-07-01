<?php

namespace App\Jobs;

use CodeIgniter\Queue\BaseJob;
use CodeIgniter\Queue\Interfaces\JobInterface;

class AssignPartner extends BaseJob implements JobInterface
{
    public function process()
    {
        $get_order_obj = new \App\Models\Orders();
        $get_order = $get_order_obj->find($this->data['order_id']);
        $get_partners = new \App\Models\PartnerDetails();
        $get_partners = $get_partners->where('JSON_CONTAINS(college_assigned_id,"' . $get_order['college_id'] . '","$")', 1)->findAll();
        foreach ($get_partners as $value) {
            $check_partner_ord = $get_order_obj->where('partner_id', $value['id'])->findAll();
            if (count($check_partner_ord) < 50) {
                $upd_arr = [
                    'partner_id' => $value['id']
                ];
                $get_order_obj->update([$this->data['order_id']], $upd_arr);
                return true;
            } else {
                continue;
            }
        }
    }
}
