<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PartnerDetails;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Entities\User;

class PartnersController extends BaseController
{
    public function index()
    {
        $postdata = $this->request->getPost();
        if (!empty($postdata)) {
            try {
                if (isset($postdata['edit_id'])) {
                    $data = array_shift($this->partner_details->select(['auth_identities.name', 'auth_identities.secret', 'partner_details.*'])->join('auth_identities', 'auth_identities.user_id=partner_details.user_id')->where('partner_details.id', $postdata['edit_id'])->find());
                    $data['bank_details'] = json_decode($data['bank_details'], true);
                    $data['college_assigned_id'] = json_decode($data['college_assigned_id'], true);
                    $data['gst_details'] = json_decode($data['gst_details'], true);
                    return $this->response->setJSON(['csrf' => csrf_hash(), 'data' => $data]);
                }
                if (isset($postdata['delete_id'])) {
                    $data = array_shift($this->partner_details->where('id', $postdata['delete_id'])->find());
                    if($this->partner_details->set(['status' => PartnerDetails::STATUS_INACTIVE])->where('id', $postdata['delete_id'])->update()){
                        $user = auth()->getProvider();
                        $deluser = $user->findById($data['user_id']);
                        $deluser->deactivate();
                        $data = 1;
                    }else{
                        $data = 0;
                    }
                    return $this->response->setJSON(['csrf' => csrf_hash(), 'status' => $data]);
                }
                if (isset($postdata['submit_product'])) {
                    $partner = $postdata['user'];
                    unset($postdata['user']);
                    unset($postdata['submit_product']);
                    if (!isset($postdata['id'])) {
                        $all_users = auth()->getProvider();
                        $last_id = $this->users->orderBy('id desc')->asArray()->limit(1, 0)->findAll();
                        if (count($last_id) == 0) {
                            $last_id = 0;
                        } else {
                            $last_id = array_shift($last_id)['id'];
                        }
                        $new_user = new User([
                            'username' => 'USER_' . $last_id,
                            'email'    => $partner['email'],
                            'password' => 'pass123'
                        ]);

                        if ($all_users->save($new_user)) {
                            $save_user = $all_users->findById($all_users->getInsertID());
                            $this->userIdentities->set(['name' => $partner['name']])->where('user_id', $save_user->id)->update();
                            $save_user->activate();
                            $save_user->addGroup('partner');
                            $postdata['user_id'] = $save_user->id;
                            $data['status'] = 1;
                        } else {
                            $data['status'] = 0;
                        }
                    }

                    $postdata['status'] = PartnerDetails::STATUS_ACTIVE;
                    $postdata['college_assigned_id'] = json_encode($postdata['college_assigned_id']);
                    $postdata['bank_details'] = json_encode($postdata['bank_details']);
                    $postdata['gst_details'] = json_encode($postdata['gst_details']);
                    if ($this->partner_details->save($postdata)) {
                        $data['status'] = 1;
                    } else {
                        $data['status'] = 0;
                    }

                    return $this->response->setJSON(['csrf' => csrf_hash(), 'data' => $data['status']]);
                }
            } catch (\Throwable $e) {
                return $this->response->setJSON(['csrf' => csrf_hash(), 'data' => $e]);
            }
        }
        $data['partners'] = $this->partner_details->select(['auth_identities.name', 'partner_details.*'])->join('auth_identities', 'auth_identities.user_id=partner_details.user_id')->where('status', PartnerDetails::STATUS_ACTIVE)->findAll();
        $colleges = $this->institutes->findAll();
        $data['colleges'] = array_reduce($colleges, function ($carry, $val) {
            $carry[$val['id']] = $val;
            return $carry;
        });
        return $this->render_page('partners/index', $data);
    }
}
