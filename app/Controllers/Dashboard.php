<?php
// app/Controllers/Dashboard.php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title'       => 'Dashboard',
        ];

        return $this->render('pages/dashboard/dashboard', $data);
    }
}