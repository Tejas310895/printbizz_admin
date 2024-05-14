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
            if (isset($postdata['edit_id'])) {
                $edit_group = $this->itemnary_group->ItemnaryGroup([$postdata['edit_id']]);
                return $this->response->setJSON(['csrf' => csrf_hash(), 'data' => array_shift($edit_group)]);
            }
            if (isset($postdata['delete_id'])) {
                try {
                    $this->itemnary->where('item_group_id', $postdata['delete_id'])->set(['status' => ProductItemnary::STATUS_INACTIVE])->update();
                    $this->itemnary_group->where('id', $postdata['delete_id'])->set(['status' => ProductItemnary::STATUS_INACTIVE])->update();
                    return $this->response->setJSON(['csrf' => csrf_hash(), 'status' => 1]);
                } catch (\Throwable $e) {
                    return $this->response->setJSON(['csrf' => csrf_hash(), 'status' => $e]);
                }
            }
            if (isset($postdata['fetch_data'])) {
                $data_g = $this->itemnary_group->ItemnaryGroup();
                return $this->response->setJSON(['csrf' => csrf_hash(), 'data' => $data_g]);
            }
            $status = 1;
            try {
                $group_arr = [
                    'name' => $postdata['name'],
                    'type' => $postdata['type'],
                    'status' => ModelsPartnerDetails::STATUS_ACTIVE
                ];
                if (isset($postdata['id'])) {
                    $this->itemnary->where('item_group_id', $postdata['id'])->set(['status' => ProductItemnary::STATUS_INACTIVE])->update();
                    $group_arr['id'] = $postdata['id'];
                }
                if ($this->itemnary_group->save($group_arr)) {
                    $group_id = (isset($postdata['id'])) ? $postdata['id'] : $this->itemnary_group->getInsertID();
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
                echo $e;
            }
            return $this->response->setJSON(['csrf' => csrf_hash(), 'status' => $status]);
        }
        $data['groups'] = $this->itemnary_group->ItemnaryGroup();
        return $this->render_page('products/itemnary', $data);
    }
}
