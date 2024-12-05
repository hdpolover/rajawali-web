<?php
// app/Controllers/TransactionController.php

namespace App\Controllers;

class Transaction extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = session();
    }

    public function sales()
    {
        $data = [
            'title' => 'Penjualan',
            'username' => $this->session->get('username'),
            'role' => $this->session->get('role')
        ];
        return view('pages/transactions/sales', $data);
    }

    public function incoming()
    {
        $data = [
            'title' => 'Barang Masuk',
            'username' => $this->session->get('username'),
            'role' => $this->session->get('role')
        ];
        return view('pages/transactions/incoming', $data);
    }
}