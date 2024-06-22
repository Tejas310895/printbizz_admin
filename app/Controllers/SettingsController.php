<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AppSettings;
use CodeIgniter\HTTP\ResponseInterface;

class SettingsController extends BaseController
{
    public function __construct()
    {
        $this->settings = new AppSettings();
    }
    public function index()
    {
        $postdata = $this->request->getPost();
        if (!empty($postdata)) {
            if (isset($postdata['delete_id'])) {
                try {
                    $banner_images = array_shift($this->settings->where('name', 'images')->findAll());
                    $banner_images = json_decode($banner_images['parameters'], true);
                    unset($banner_images[$postdata['delete_id']]);
                    $set_params = [
                        'parameters' => json_encode($banner_images)
                    ];
                    if ($this->settings->where('name', 'images')->set($set_params)->update()) {
                        unlink(WRITEPATH . $postdata['image']);
                        $status = 1;
                    } else {
                        $status = 0;
                    }
                } catch (\Throwable $th) {
                    throw $th;
                }
                return $this->response->setJSON(['csrf' => csrf_hash(), 'data' => $status]);
            }
            if (isset($postdata['settings_update'])) {
                try {
                    $charges = array_shift($this->settings->where('name', 'charges')->findAll());
                    $gateway = array_shift($this->settings->where('name', 'gateway')->findAll());
                    $charges = json_decode($charges['parameters'], true);
                    $gateway = json_decode($gateway['parameters'], true);
                    $set_charges = [
                        'parameters' => json_encode($postdata['charges'])
                    ];
                    $set_gateway = [
                        'parameters' => json_encode($postdata['gateway'])
                    ];
                    if ($this->settings->where('name', 'charges')->set($set_charges)->update() && $this->settings->where('name', 'gateway')->set($set_gateway)->update()) {
                        $status = 1;
                    } else {
                        $status = 0;
                    }
                } catch (\Throwable $th) {
                    throw $th;
                }
                return $this->response->setJSON(['csrf' => csrf_hash(), 'data' => $status]);
            }
            if (isset($postdata['image_upload'])) {
                try {
                    unset($postdata['image_upload']);
                    if ($this->request->getFile('banner_images')->getSize() > 0) {
                        $img = $this->request->getFile('banner_images');
                        $newName = $img->getRandomName();
                        if (!$img->hasMoved()) {
                            $filepath = 'uploads/' . $img->store('banner_img/' . date('Ymd'), $newName);
                            $to_be_uploaded = $filepath;
                            $status = 1;
                        } else {
                            $status = 0;
                        }
                    } else {
                        $status = 1;
                    }
                    if ($status == 1) {
                        $banner_images = array_shift($this->settings->where('name', 'images')->findAll());
                        $banner_images = json_decode($banner_images['parameters'], true);
                        $banner_images[$postdata['position']] = $to_be_uploaded;
                        $set_params = [
                            'parameters' => json_encode($banner_images)
                        ];
                        if ($this->settings->where('name', 'images')->set($set_params)->update()) {
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
        $data['settings'] = $this->settings->findAll();
        return $this->render_page('settings', $data);
    }
}
