<?php
// app/Controllers/Dashboard.php

namespace App\Controllers;

class SparePart extends BaseController
{
    public function index()
    {
        $data = [
            'title'       => 'Pelanggan',
            'username'    => $this->session->get('username'),
            'role'        => $this->session->get('role'),
            'breadcrumbs' => $this->getBreadcrumbs(),
        ];

        return view('pages/customer/customer', $data);
    }
}