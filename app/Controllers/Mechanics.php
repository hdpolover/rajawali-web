<?php
// app/Controllers/Dashboard.php

namespace App\Controllers;

use App\Models\MechanicModel;
use App\Models\ActivityLogModel;

class Mechanics extends BaseController
{
    protected $mechanicModel;
    protected $activityLogModel;

    public function __construct()
    {
        $this->mechanicModel = new MechanicModel();
        $this->activityLogModel = new ActivityLogModel();
    }

    public function index()
    {
        $data = [
            'title'       => 'Data Mekanik',
            'mechanics' => $this->mechanicModel->findAll(),
        ];

        return $this->render('pages/mechanic/index', $data);
    }    // add function
    public function add()
    {
        // get form data
        $formData = [
            'name'   => $this->request->getPost('name'),
            'phone'  => $this->request->getPost('phone'),
        ];

        // validate form data
        $validation = \Config\Services::validation();

        // Set validation rules
        $validation->setRules($this->mechanicModel->getValidationRules());

        // Validate
        if (!$validation->run($formData)) {
            return redirect()->to('/master-data/mechanics')->withInput()->with('errors', $validation->getErrors());
        }

        // insert data
        $savedData = $this->mechanicModel->save($formData);

        if ($savedData) {
            // add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'mechanics',
                'action_type' => 'add',
                'old_value' => null,
                // get the new value name from the saved data
                'new_value' => $formData['name'],
            ];

            $this->activityLogModel->saveActivityLog($logData);

            // show success message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'success',
                'message' => 'Data mekanik berhasil ditambahkan.'
            ]);
        } else {
            // show error message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Gagal menambahkan data mekanik.'
            ]);
        }

        return redirect()->to('/master-data/mechanics');
    }    // edit function
    public function edit()
    {
        // get form data
        $id = $this->request->getPost('id');
        $formData = [
            'id'     => $id,
            'name'   => $this->request->getPost('name'),
            'phone'  => $this->request->getPost('phone'),
        ];        // validate form data
        $validation = \Config\Services::validation();

        // Set validation rules
        $validation->setRules($this->mechanicModel->getValidationRules());

        // Validate
        if (!$validation->run($formData)) {
            return redirect()->to('/master-data/mechanics')->withInput()->with('errors', $validation->getErrors());
        }

        // get old data for activity log
        $oldData = $this->mechanicModel->find($id);

        // update data
        $updatedData = $this->mechanicModel->save($formData);

        if ($updatedData) {
            // add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'mechanics',
                'action_type' => 'edit',
                'old_value' => $oldData->name,
                'new_value' => $formData['name'],
            ];

            $this->activityLogModel->saveActivityLog($logData);

            // show success message and redirect
            session()->setFlashdata('alert', [
                'type' => 'success',
                'message' => 'Data mekanik berhasil diperbarui.'
            ]);
        } else {
            // show error message and redirect
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Gagal memperbarui data mekanik.'
            ]);
        }

        return redirect()->to('/master-data/mechanics');
    }    // delete function
    public function delete()
    {
        // get form data
        $id = $this->request->getPost('id');

        // Validate that the ID exists
        $mechanic = $this->mechanicModel->find($id);
        if (!$mechanic) {
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Data mekanik tidak ditemukan.'
            ]);
            return redirect()->to('/master-data/mechanics');
        }

        // delete data
        $deletedData = $this->mechanicModel->delete($id);

        if ($deletedData) {
            // add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'mechanics',
                'action_type' => 'delete',
                'old_value' => $mechanic->name,
                'new_value' => null,
            ];

            $this->activityLogModel->saveActivityLog($logData);

            // show success message and redirect
            session()->setFlashdata('alert', [
                'type' => 'success',
                'message' => 'Data mekanik berhasil dihapus.'
            ]);
        } else {
            // show error message and redirect
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Gagal menghapus data mekanik.'
            ]);
        }

        return redirect()->to('/master-data/mechanics');
    }

    // fetch data
    public function fetch()
    {
        $response = array();

        $searchTerm = $this->request->getPost('name');

        // if search term is not empty
        if ($searchTerm) {
            $mechanics = $this->mechanicModel->select('id,name')
                ->like('name', $searchTerm)
                ->orderBy('name')
                ->findAll();
        } else {
            $mechanics = $this->mechanicModel->select('id,name')
                ->orderBy('name')
                ->findAll();
        }

        // return data as data with id and name
        $data = [];

        foreach ($mechanics as $mechanic) {
            $data[] = [
                // convert id to int
                'id' => (int)$mechanic->id,
                'text' => $mechanic->name,
            ];
        }

        $response['data'] = $data;

        return $this->response->setJSON($response);
    }

    // archive methods
    public function archived()
    {
        $data = [
            'title'       => 'Data Mekanik Diarsipkan',
            'mechanics'   => $this->mechanicModel->onlyDeleted()->findAll(),
        ];

        return $this->render('pages/mechanic/archived', $data);
    }

    // restore method
    public function restore($id)
    {
        // Get mechanic data
        $mechanic = $this->mechanicModel->onlyDeleted()->find($id);

        if (!$mechanic) {
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Data mekanik tidak ditemukan.'
            ]);
            return redirect()->to('/master-data/mechanics');
        }

        // Restore mechanic (remove the deletion mark)
        $this->mechanicModel->update($id, ['deleted_at' => null]);

        // Add activity log
        $logData = [
            'admin_id' => session()->get('admin_id'),
            'table_name' => 'mechanics',
            'action_type' => 'edit',
            'old_value' => 'Diarsipkan: ' . $mechanic->name,
            'new_value' => 'Dipulihkan: ' . $mechanic->name,
        ];

        $this->activityLogModel->saveActivityLog($logData);

        session()->setFlashdata('alert', [
            'type' => 'success',
            'message' => 'Data mekanik berhasil dipulihkan.'
        ]);

        return redirect()->to('/master-data/mechanics');
    }
}
