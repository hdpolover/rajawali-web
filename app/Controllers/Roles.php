<?php
// app/Controllers/Menu.php

namespace App\Controllers;

use App\Models\RoleModel;


class Roles extends BaseController
{
    protected $roleModel;

    public function __construct()
    {
        $this->roleModel = new RoleModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Peran Admin',
            'roles' => $this->roleModel->findAll(),
        ];

        return $this->render('pages/role/index', $data);
    }

    public function add()
    {
        // get form data
        $formData = [
            'name' => $this->request->getPost('name'),
        ];

        // save role data to database
        $newRole =  $this->roleModel->save($formData);

        if (!$newRole) {
            // show error message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Gagal menambahkan peran.'
            ]);

            return redirect()->to(previous_url());
        }

        // show success message and redirect to the previous page. set alert session data
        session()->setFlashdata('alert', [
            'type' => 'success',
            'message' => 'Peran berhasil ditambahkan.'
        ]);

        // add activity log
        $logData = [
            'admin_id' => session()->get('admin_id'),
            'table_name' => 'roles',
            'action' => 'add',
            'old_value' => null,
            'new_value' => $newRole,
        ];

        $this->activityLogModel->saveActivityLog($logData);

        return redirect()->to(previous_url());
    }

    public function edit($id)
    {
        // get form data
        $formData = [
            'name' => $this->request->getPost('name'),
        ];

        // update role data in database
        $updatedRole = $this->roleModel->update($id, $formData);

        if (!$updatedRole) {
            // show error message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Gagal mengubah peran.'
            ]);

            return redirect()->to(previous_url());
        }

        // show success message and redirect to the previous page. set alert session data
        session()->setFlashdata('alert', [
            'type' => 'success',
            'message' => 'Peran berhasil diubah.'
        ]);

        // add activity log
        $logData = [
            'admin_id' => session()->get('admin_id'),
            'table_name' => 'roles',
            'action' => 'edit',
            'old_value' => null,
            'new_value' => $updatedRole,
        ];

        $this->activityLogModel->saveActivityLog($logData);

        return redirect()->to(previous_url());
    }
}
