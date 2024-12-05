<?php
// app/Controllers/Dashboard.php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title'       => 'Dashboard',
            'username'    => $this->session->get('username'),
            'role'        => $this->session->get('role'),
            'breadcrumbs' => $this->getBreadcrumbs(),
        ];

        return view('pages/dashboard/dashboard', $data);
    }
}