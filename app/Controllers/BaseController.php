<?php
// app/Controllers/BaseController.php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\MenuModel;
use App\Models\ActivityLogModel;
use App\Models\AdminModel;

abstract class BaseController extends Controller
{
    protected $request;
    protected $helpers = ['custom_helper',];
    protected $session;

    protected $adminModel;
    protected $menuModel;
    protected $activityLogModel;
    protected $data = [];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        // E.g.: $this->session = \Config\Services::session();
        $this->session = session();

        // Load models
        $this->menuModel = new MenuModel();
        $this->activityLogModel = new ActivityLogModel();
        $this->adminModel = new AdminModel();

        // check if user is logged in
        if (!$this->session->get('logged_in')) {
            return redirect()->to('login');
        }

        // Set global data
        $this->data['username'] = $this->session->get('username');
        $this->data['role'] = $this->session->get('role');
        $this->data['breadcrumbs'] = $this->getBreadcrumbs();
        $this->data['admins'] = $this->adminModel->findAll();
        // get activity logs data
        $this->data['activity_logs'] = $this->activityLogModel->findAll();

        // menu data
        $roleId = session()->get('role_id');
        $this->data['menu_items'] = $this->menuModel->getMenuByRole($roleId);
    }

    protected function render($view, $data = [])
    {
        // Merge global data with view-specific data
        $data = array_merge($this->data, $data);
        return view($view, $data);
    }

    protected function getBreadcrumbs()
    {
        $currentUrl = uri_string(); // Get the current URI
        $breadcrumbs = $this->menuModel->getBreadcrumbs($currentUrl);
        return $breadcrumbs;
    }
}
