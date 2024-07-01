<?php

namespace App\Controllers;

use Config\Services;

class MainController extends BaseController
{
    public function index(): string
    {
        return $this->render_page('dashboard');
    }
}
