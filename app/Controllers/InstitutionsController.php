<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Institutions;
use CodeIgniter\HTTP\ResponseInterface;

class InstitutionsController extends BaseController
{
    public function index()
    {
        $postdata = $this->request->getPost();
        if (!empty($postdata)) {
            if (isset($postdata['edit_id'])) {
                $data = array_shift($this->institutes->asArray()->where('id', $postdata['edit_id'])->find());
                return $this->response->setJSON(['csrf' => csrf_hash(), 'data' => $data]);
            }
            if (isset($postdata['delete_id'])) {
                try {
                    $this->institutes->where('id', $postdata['delete_id'])->set(['status' => Institutions::STATUS_INACTIVE])->update();
                    return $this->response->setJSON(['csrf' => csrf_hash(), 'status' => 1]);
                } catch (\Throwable $e) {
                    return $this->response->setJSON(['csrf' => csrf_hash(), 'status' => $e]);
                }
            }
            if (isset($postdata['submit_product'])) {
                unset($postdata['submit_product']);
                if (!isset($postdata['id'])) {
                    $postdata['status'] = Institutions::STATUS_ACTIVE;
                }
                if ($this->institutes->save($postdata)) {
                    $status = 1;
                } else {
                    $status = 0;
                }
                return $this->response->setJSON(['csrf' => csrf_hash(), 'data' => $status]);
            }
        }
        $data['institutions'] = $this->institutes->where('status', Institutions::STATUS_ACTIVE)->findAll();
        return $this->render_page('institutions/index', $data);
    }
}
