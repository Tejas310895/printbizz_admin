<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Coupon;
use CodeIgniter\HTTP\ResponseInterface;

class CouponController extends BaseController
{
    public function index()
    {
        $data['coupons'] = $this->coupons->where('status', Coupon::STATUS_ACTIVE)->findAll();
        $postdata = $this->request->getPost();
        if (!empty($postdata)) {
            if (isset($postdata['submit_coupon'])) {
                unset($postdata['submit_coupon']);
                if ($this->coupons->save($postdata)) {
                    $status = 1;
                } else {
                    $status = 0;
                }
                return $this->response->setJSON(['csrf' => csrf_hash(), 'data' => $status]);
            } elseif (isset($postdata['id'])) {
                if ($this->coupons->save($postdata)) {
                    $status = 1;
                } else {
                    $status = 0;
                }
                return $this->response->setJSON(['csrf' => csrf_hash(), 'data' => $status]);
            }
        }
        return $this->render_page('coupon/index', $data);
    }
}
