<?php

namespace App\Controllers;

class MainController extends BaseController
{
    public function index(): string
    {
        return $this->render_page('dashboard');
    }
}
