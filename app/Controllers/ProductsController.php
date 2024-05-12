<?php

namespace App\Controllers;

use App\Models\PartnerDetails as ModelsPartnerDetails;
use App\Models\ProductItemnary;

class ProductsController extends BaseController
{
    public function index()
    {
        $products = $this->products->asArray()->findAll();
        $data['products'] = [];
        foreach ($products as $product) {
            $product['groups'] = $this->itemnary_group->ItemnaryGroup(json_decode($product['itemnary'], true));
            array_push($data['products'], $product);
        }
        return $this->render_page('products/index', $data);
    }

    public function itemnary()
    {
        $postdata = $this->request->getPost();
        if (!empty($postdata)) {
            $status = 1;
            try {
                $group_arr = [
                    'name' => $postdata['name'],
                    'type' => $postdata['type'],
                    'status' => ModelsPartnerDetails::STATUS_ACTIVE
                ];
                if ($this->itemnary_group->save($group_arr)) {
                    $group_id = $this->itemnary_group->getInsertID();
                    foreach ($postdata as $key => $value) {
                        if (strpos($key, 'group_items') !== false) {
                            $sub_arr = json_decode($value, true);
                            $sub_arr['item_group_id'] = $group_id;
                            $sub_arr['icons'] = '';
                            $sub_arr['status'] = ProductItemnary::STATUS_ACTIVE;
                            $this->itemnary->save($sub_arr);
                        }
                    }
                } else {
                    $status = 0;
                }
            } catch (\Exception $e) {
            }
            return $this->response->setJSON(['csrf' => csrf_hash(), 'status' => $status]);
        }
        $data['groups'] = $this->itemnary_group->ItemnaryGroup();
        return $this->render_page('products/itemnary', $data);
    }
}
