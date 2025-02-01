<?php
// app/Controllers/Dashboard.php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\RoleModel;

class Admins extends BaseController
{

    protected $roleModel;

    public function __construct()
    {
        $this->roleModel = new RoleModel();
    }

    public function index()
    {
        $data = [
            'title'       => 'Data Admin',
            'roles' => $this->roleModel->findAll(),
        ];

        return $this->render('pages/admin/index', $data);
    }

    public function add()
    {
        // get form data
        $formData = [
            'username' => $this->request->getPost('add_username'),
            'email'    => $this->request->getPost('add_email'),
            'password' => $this->request->getPost('add_password'),
            'role_id'  => $this->request->getPost('add_role'),
            'active'   => 1,
        ];
        
        // save supplier data to database
        $newAdmin =  $this->adminModel->save($formData);

        if (!$newAdmin) {
            // show error message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Gagal menambahkan admin.'
            ]);

            return redirect()->to(previous_url());
        }

        // show success message and redirect to the previous page. set alert session data
        session()->setFlashdata('alert', [
            'type' => 'success',
            'message' => 'Admin berhasil ditambahkan.'
        ]);

        return redirect()->to('/admins');
    }

    public function edit()
    {
        // get supplier id from form data
        $id = $this->request->getPost('edit_id');

        // get form data
        $formData = [
            'username' => $this->request->getPost('edit_username'),
            'email'    => $this->request->getPost('edit_email'),
            'role_id'  => $this->request->getPost('edit_role'),
            'active'   => $this->request->getPost('edit_active'),
        ];

        // update supplier data to database where id is id and where is form data
        $updateAdmin = $this->adminModel->update($id, $formData);

        if (!$updateAdmin) {
            // show error message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Gagal mengubah admin.'
            ]);

            return redirect()->to(previous_url());
        }

        // show success message and redirect to the previous page. set alert session data
        session()->setFlashdata('alert', [
            'type' => 'success',
            'message' => 'Admin berhasil diubah.'
        ]);

        return redirect()->to('/admins');
    }

    public function delete()
    {
        // get supplier id from form data
        $id = $this->request->getPost('delete_id');

        $formData = [
            'deleted_at' => date('Y-m-d H:i:s')
        ];
        // delete supplier data from database by updating the deleted_at field, but dont actually delete it
        $deleteSupplier = $this->adminModel->update($id, $formData);

        if (!$deleteSupplier) {
            // show error message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Gagal menghapus supplier.'
            ]);

            return redirect()->to(previous_url());
        }

        // show success message and redirect to the previous page. set alert session data
        session()->setFlashdata('alert', [
            'type' => 'success',
            'message' => 'Supplier berhasil dihapus.'
        ]);

        return redirect()->to('/suppliers');
    }
}
