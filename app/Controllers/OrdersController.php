<?php

namespace App\Controllers;

use App\Models\PartnerDetails;

class OrdersController extends BaseController
{
    public function index()
    {
        $data = [];
        $orders = $this->orders->select('orders.*,auth_identities.name,auth_identities.secret')
            ->join('auth_identities', 'auth_identities.user_id=orders.user_id', 'left')
            ->orderBy('orders.created_at,orders.status')
            ->limit(10)
            ->findAll();
        $partners = $this->partner_details->select('partner_details.*,auth_identities.name')->join('auth_identities', 'auth_identities.user_id=partner_details.user_id', 'left')->where('status', PartnerDetails::STATUS_ACTIVE)->findAll();
        $partners = array_reduce($partners, function ($carry, $val) {
            $carry[$val['id']] = $val;
            return $carry;
        });
        foreach ($partners as $key => $partner) {
            $colleges = $this->institutes->select(['id', 'name'])->whereIn('id', json_decode($partner['college_assigned_id']))->findAll();
            $partner['colleges'] = array_reduce($colleges, function ($carry, $val) {
                $carry[$val['id']] = $val['name'];
                return $carry;
            });
            $partners[$key] = $partner;
        }
        foreach ($orders as $key => $value) {
            $itemnary = array_shift(json_decode($value['itemnary'], true));
            $price = $itemnary['default_price'];
            foreach ($itemnary['itemnary_multi'] as $mitems) {
                $price += json_decode($mitems, true)['price'];
            }
            foreach ($itemnary['itemnary_single'] as $sitems) {
                $price += json_decode($sitems, true)['price'];
            }
            $value['tot_price'] = $price * ($itemnary['copies'] * $itemnary['pages']);
            $data[$key] = $value;
        }
        $data['data'] = $data;
        $data['partners'] = $partners;
        return $this->render_page('orders/index', $data);
    }
}
