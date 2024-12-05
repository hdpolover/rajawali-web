<?php
// app/Controllers/Auth.php

namespace App\Controllers;

use App\Models\AdminModel;

class Auth extends BaseController
{
    protected $adminModel;
    protected $session;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->session = session();
    }

    public function index()
    {
        // If already logged in, redirect to dashboard
        if ($this->session->get('logged_in')) {
            return redirect()->to('dashboard');
        }

        return view('pages/auth/login');
    }

    public function login()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()
                ->with('error', 'Username dan password wajib diisi');
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $admin = $this->adminModel->authenticate($username, $password);

        if ($admin) {
            $this->session->set([
                'user_id' => $admin->id,
                'username' => $admin->username,
                'role_id' => $admin->role_id,
                'role' => $admin->role_name,
                'logged_in' => true
            ]);
            return redirect()->to('dashboard');
        }

        return redirect()->back()
            ->with('error', 'Username atau password salah');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('login');
    }
}
