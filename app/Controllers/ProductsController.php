<?php

namespace App\Controllers;

use App\Models\PartnerDetails as ModelsPartnerDetails;
use App\Models\ProductItemnary;
use App\Models\Products;

class ProductsController extends BaseController
{
    public function index()
    {
        $postdata = $this->request->getPost();
        if ($postdata) {
            if (isset($postdata['fetch_data'])) {
                $data['products'] = [];
            $products = $this->products->asArray()->where('status' , Products::STATUS_ACTIVE)->findAll();
                $data['groups'] = $this->itemnary_group->ItemnaryGroup();
                foreach ($products as $product) {
                    $product['groups'] = $this->itemnary_group->ItemnaryGroup(json_decode($product['itemnary'], true));
                    array_push($data['products'], $product);
                }
                return $this->response->setJSON(['csrf' => csrf_hash(), 'data' => $data]);
            }
            if (isset($postdata['edit_id'])) {
                $data = array_shift($this->products->asArray()->where('id', $postdata['edit_id'])->find());
                $data['itemnary'] = json_decode($data['itemnary']);
                return $this->response->setJSON(['csrf' => csrf_hash(), 'data' => $data]);
            }
            if (isset($postdata['delete_id'])) {
                try {
                    $this->products->where('id', $postdata['delete_id'])->set(['status' => Products::STATUS_INACTIVE])->update();
                    return $this->response->setJSON(['csrf' => csrf_hash(), 'status' => 1]);
                } catch (\Throwable $e) {
                    return $this->response->setJSON(['csrf' => csrf_hash(), 'status' => $e]);
                }
            }
            if (isset($postdata['submit_product'])) {
                try {
                    unset($postdata['submit_product']);
                    if ($this->request->getFile('img')->getSize() > 0) {
                        $img = $this->request->getFile('img');
                        $newName = $img->getRandomName();
                        if (!$img->hasMoved()) {
                            $filepath = 'uploads/' . $img->store('admin_img/' . date('Ymd'), $newName);
                            $postdata['img'] = json_encode([$filepath]);
                            $status = 1;
                        } else {
                            $status = 0;
                        }
                    } else {
                        $status = 1;
                    }
                    if ($status == 1) {
                        $postdata['itemnary'] = array_map('intval', $postdata['itemnary']);
                        $postdata['itemnary'] = json_encode($postdata['itemnary']);
                        $postdata['status'] = Products::STATUS_ACTIVE;
                        $postdata['created_by'] = (auth()->user()) ? auth()->user()->id : null;
                        $postdata['updated_by'] = (auth()->user()) ? auth()->user()->id : null;
                        if ($this->products->save($postdata)) {
                            $status = 1;
                        } else {
                            unlink(WRITEPATH . $filepath);
                            $status = 0;
                        }
                    }
                } catch (\Throwable $e) {
                    echo $e;
                    $status = 0;
                }
                return $this->response->setJSON(['csrf' => csrf_hash(), 'data' => $status]);
            }
        }
        return $this->render_page('products/index');
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
