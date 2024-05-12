<?php

namespace App\Controllers;

use App\Libraries\MenuLibrary;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Models\UserIdentityModel;
use CodeIgniter\Shield\Models\UserModel;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->products = new \App\Models\Products();
        $this->itemnary_group = new \App\Models\ProductItemnaryGroup();
        $this->itemnary = new \App\Models\ProductItemnary();
        $this->institutes = new \App\Models\Institutions();
        $this->partner_details = new \App\Models\PartnerDetails();
        $this->orders = new \App\Models\Orders();
        $this->users = new UserModel();
        $this->userIdentities = new UserIdentityModel();
    }

    protected function render_page($view, $data = [])
    {
        $menu_data['menu'] = MenuLibrary::get_menu();
        return view('includes/header') .
            view('includes/sidebar', $menu_data) .
            view($view, $data) .
            view('includes/footer');
    }
}
