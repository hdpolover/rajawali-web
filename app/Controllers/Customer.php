<?php
// app/Controllers/Dashboard.php

namespace App\Controllers;

class Customer extends BaseController
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

    public function search()
    {
        // Dummy data for customers
        $customers = [
            ['id' => 1, 'text' => 'John Doe'],
            ['id' => 2, 'text' => 'Jane Smith'],
            ['id' => 3, 'text' => 'Alice Johnson'],
        ];

        return $this->response->setJSON($customers);
    }
}