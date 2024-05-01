<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class CallApiController extends ResourceController
{

    protected $format    = 'json';
    public function image_upload()
    {
        $postdata = $this->request->getPost();
        $tmp_name = $_FILES["name"]["tmp_name"];
        $name = $_FILES["name"]["name"];
        $path = WRITEPATH . '/uploads/' . $postdata['folder'] . '/' . basename($name);
        if (!is_dir(WRITEPATH . '/uploads/' . $postdata['folder'])) {
            mkdir(WRITEPATH . '/uploads/' . $postdata['folder']);
        }
        move_uploaded_file($tmp_name, $path);
        return $this->respond($postdata);
    }
}
