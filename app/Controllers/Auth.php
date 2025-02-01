<?php
// app/Controllers/Auth.php

namespace App\Controllers;

use App\Models\AdminModel;

class Auth extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
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
            'email' => 'required',
            'password' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()
                ->with('error', 'Email dan password wajib diisi');
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $admin = $this->adminModel->authenticate($email, $password);

        if ($admin) {
            $this->session->set([
                'admin_id' => $admin->id,
                'email' => $admin->email,
                'username' => $admin->username,
                'role_id' => $admin->role_id,
                'role' => $admin->role_name,
                'logged_in' => true
            ]);
            return redirect()->to('dashboard');
        }

        return redirect()->back()
            ->with('error', 'Email atau password salah');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('login');
    }
}
