<?php
// app/Controllers/Dashboard.php

namespace App\Controllers;

class Dashboard extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {
        // Get user data from session
        $data = [
            'title' => 'Dashboard',
            'username' => $this->session->get('username'),
            'role' => $this->session->get('role')
        ];

        // Load stats/summary data here
        // TODO: Add dashboard statistics

        return view('pages/dashboard/dashboard', $data);
    }
}
