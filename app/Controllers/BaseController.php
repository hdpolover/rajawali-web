<?php
// app/Controllers/BaseController.php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\MenuModel;

abstract class BaseController extends Controller
{
    protected $request;
    protected $helpers = [];
    protected $session;
    protected $menuModel;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Initialize session
        $this->session = \Config\Services::session();

        // Load MenuModel
        $this->menuModel = new MenuModel();
    }

    protected function getBreadcrumbs()
    {
        $currentUrl = uri_string(); // Get the current URI
        $breadcrumbs = $this->menuModel->getBreadcrumbs($currentUrl);
        return $breadcrumbs;
    }
}