<?php

namespace App\Controllers;

use App\Models\PartnerDetails;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Models\UserIdentityModel;
use CodeIgniter\Shield\Models\UserModel;

class ProductsController extends BaseController
{
    public function index()
    {
        return $this->render_page('products');
    }
}
