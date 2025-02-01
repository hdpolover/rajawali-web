<?php

namespace App\Controllers;

class Returns extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Data Return Sparepart',
        ];

        return $this->render('pages/transactions/returns/index', $data);
    }
}