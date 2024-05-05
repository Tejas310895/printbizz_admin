<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Models\UserIdentityModel;
use CodeIgniter\Shield\Models\UserModel;

class OrdersController extends BaseController
{
    public function __construct()
    {
        $this->products = new \App\Models\Products();
        $this->itemnary_group = new \App\Models\ProductItemnaryGroup();
        $this->itemnary = new \App\Models\ProductItemnary();
        $this->institutes = new \App\Models\Institutions();
        $this->orders = new \App\Models\Orders();
        $this->users = new UserModel();
        $this->userIdentities = new UserIdentityModel();
    }
    public function index()
    {

        $postdata = $this->request->getPost();
        if (!empty($postdata)) {
            $data = [];
            $orders = $this->orders->select('orders.*,auth_identities.name,auth_identities.secret')
                ->where('orders.id >', $postdata['last_id'])
                ->join('auth_identities', 'auth_identities.user_id=orders.user_id', 'left')
                ->orderBy('orders.created_at,orders.status')
                ->limit(10)
                ->findAll();
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
            return $this->response->setJSON($data);
        }
        return $this->render_page('orders');
    }
}
