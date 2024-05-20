<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CustomersController extends BaseController
{
    public function index()
    {
        $data['customers_list'] = auth()->getProvider()->withIdentities()->findAll();
        $data['orders'] = $this->orders->getCustomerOrders();
        return $this->render_page('customers/index', $data);
    }
}
