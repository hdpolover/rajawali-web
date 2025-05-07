<?php
// app/Controllers/Motorcycles.php

namespace App\Controllers;

use App\Models\MotorcycleModel;
use App\Models\CustomerModel;

class Motorcycles extends BaseController
{
    protected $motorcycleModel;
    protected $customerModel;

    public function __construct()
    {
        $this->motorcycleModel = new MotorcycleModel();
        $this->customerModel = new CustomerModel();
    }    public function index()
    {
        $data = [
            'title'       => 'Data Motor Pelanggan',
            'motorcycles' => $this->motorcycleModel->getMotorcycles(),
            'customers' => $this->customerModel->findAll()
        ];

        return $this->render('pages/motorcycles/index', $data);
    }

    // add function
    public function add()
    {
        // get form data
        $formData = [
            'model'   => $this->request->getPost('model'),
            'brand'  => $this->request->getPost('brand'),
            'customer_id' => $this->request->getPost('customer_id'),
            'license_number' => $this->request->getPost('license_number')
        ];

        // validate form data
        if (!$this->validate($this->motorcycleModel->getValidationRules())) {
            return redirect()->to('/master-data/motorcycles')->withInput()->with('errors', $this->validator->getErrors());
        }

        // insert data
        $savedData = $this->motorcycleModel->save($formData);

        if ($savedData) {
            // add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'motorcycles',
                'action_type' => 'add',
                'old_value' => null,
                // get the new value name from the saved data
                'new_value' => $formData['model'],
            ];

            $this->activityLogModel->saveActivityLog($logData);

            // show success message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'success',
                'message' => 'Data berhasil ditambahkan'
            ]);
        } else {
            // show error message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Data gagal ditambahkan'
            ]);
        }

        return redirect()->to('/master-data/motorcycles');
    }

    // add function
    public function addAlt()
    {
        $response = ['success' => false, 'message' => ''];

        // get form data
        $formData = [
            'model'   => $this->request->getPost('model'),
            'brand'  => $this->request->getPost('brand'),
            'customer_id' => $this->request->getPost('customer_id'),
            'license_number' => $this->request->getPost('license_number')
        ];

        // validate form data
        if (!$this->validate($this->motorcycleModel->getValidationRules())) {
            $response['message'] = $this->validator->getErrors();
            return $this->response->setJSON($response);
        }

        // insert data
        $savedData = $this->motorcycleModel->save($formData);

        if ($savedData) {
            $response['success'] = true;
            $response['data'] = $this->motorcycleModel->find($this->motorcycleModel->insertID);
        } else {
            $response['message'] = 'Data gagal ditambahkan';
        }        return $this->response->setJSON($response);
    }
      // update function
    public function update()
    {
        $id = $this->request->getPost('id');
        
        if (!$id) {
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'ID motor tidak ditemukan'
            ]);
            return redirect()->to('/master-data/motorcycles');
        }

        // get existing data to save in activity log
        $existingData = $this->motorcycleModel->find($id);
        if (!$existingData) {
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Data motor tidak ditemukan'
            ]);
            return redirect()->to('/master-data/motorcycles');
        }

        // get form data
        $formData = [
            'id' => $id,
            'model' => $this->request->getPost('model'),
            'brand' => $this->request->getPost('brand'),
            'customer_id' => $this->request->getPost('customer_id'),
            'license_number' => $this->request->getPost('license_number')
        ];

        // validate form data
        if (!$this->validate($this->motorcycleModel->getValidationRules())) {
            return redirect()->to('/master-data/motorcycles')->withInput()->with('errors', $this->validator->getErrors());
        }

        // update data
        $savedData = $this->motorcycleModel->save($formData);

        if ($savedData) {
            // add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'motorcycles',
                'action_type' => 'update',
                'old_value' => $existingData->brand . ' ' . $existingData->model . ' - ' . $existingData->license_number,
                'new_value' => $formData['brand'] . ' ' . $formData['model'] . ' - ' . $formData['license_number'],
            ];

            $this->activityLogModel->saveActivityLog($logData);

            // show success message
            session()->setFlashdata('alert', [
                'type' => 'success',
                'message' => 'Data berhasil diperbarui'
            ]);
        } else {
            // show error message
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Data gagal diperbarui'
            ]);
        }

        return redirect()->to('/master-data/motorcycles');
    }

    // update function for AJAX
    public function updateAlt()
    {
        $response = ['success' => false, 'message' => ''];

        $id = $this->request->getPost('id');
        if (!$id) {
            $response['message'] = 'ID motor tidak ditemukan';
            return $this->response->setJSON($response);
        }

        // get existing data for activity log
        $existingData = $this->motorcycleModel->find($id);
        if (!$existingData) {
            $response['message'] = 'Data motor tidak ditemukan';
            return $this->response->setJSON($response);
        }

        // get form data
        $formData = [
            'id' => $id,
            'model' => $this->request->getPost('model'),
            'brand' => $this->request->getPost('brand'),
            'customer_id' => $this->request->getPost('customer_id'),
            'license_number' => $this->request->getPost('license_number')
        ];

        // validate form data
        if (!$this->validate($this->motorcycleModel->getValidationRules())) {
            $response['message'] = $this->validator->getErrors();
            return $this->response->setJSON($response);
        }

        // update data
        $savedData = $this->motorcycleModel->save($formData);

        if ($savedData) {
            // add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'motorcycles',
                'action_type' => 'update',
                'old_value' => $existingData->brand . ' ' . $existingData->model . ' - ' . $existingData->license_number,
                'new_value' => $formData['brand'] . ' ' . $formData['model'] . ' - ' . $formData['license_number'],
            ];

            $this->activityLogModel->saveActivityLog($logData);

            $response['success'] = true;
            $response['data'] = $this->motorcycleModel->find($id);
        } else {
            $response['message'] = 'Data gagal diperbarui';
        }        return $this->response->setJSON($response);
    }
      // delete function
    public function delete()
    {
        $id = $this->request->getPost('id');
        
        if (!$id) {
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'ID motor tidak ditemukan'
            ]);
            return redirect()->to('/master-data/motorcycles');
        }

        // get existing data for activity log
        $existingData = $this->motorcycleModel->find($id);
        if (!$existingData) {
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Data motor tidak ditemukan'
            ]);
            return redirect()->to('/master-data/motorcycles');
        }

        // delete data
        $deleted = $this->motorcycleModel->delete($id);

        if ($deleted) {
            // add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'motorcycles',
                'action_type' => 'delete',
                'old_value' => "{$existingData->brand} {$existingData->model} - {$existingData->license_number}",
                'new_value' => null,
            ];

            $this->activityLogModel->saveActivityLog($logData);

            // show success message
            session()->setFlashdata('alert', [
                'type' => 'success',
                'message' => 'Data berhasil dihapus'
            ]);
        } else {
            // show error message
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Data gagal dihapus'
            ]);
        }

        return redirect()->to('/master-data/motorcycles');
    }

    // delete function for AJAX
    public function deleteAlt()
    {
        $response = ['success' => false, 'message' => ''];

        $id = $this->request->getPost('id');
        if (!$id) {
            $response['message'] = 'ID motor tidak ditemukan';
            return $this->response->setJSON($response);
        }

        // get existing data for activity log
        $existingData = $this->motorcycleModel->find($id);
        if (!$existingData) {
            $response['message'] = 'Data motor tidak ditemukan';
            return $this->response->setJSON($response);
        }

        // delete data
        $deleted = $this->motorcycleModel->delete($id);

        if ($deleted) {
            // add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'motorcycles',
                'action_type' => 'delete',
                'old_value' => "{$existingData->brand} {$existingData->model} - {$existingData->license_number}",
                'new_value' => null,
            ];

            $this->activityLogModel->saveActivityLog($logData);

            $response['success'] = true;
        } else {
            $response['message'] = 'Data gagal dihapus';
        }

        return $this->response->setJSON($response);
    }

    public function fetchByCustomerId()
    {
        $customerId = $this->request->getVar('customer_id');

        if (!$customerId) {
            return $this->response->setJSON([
                'success' => false,
                'data' => []
            ]);
        }

        $motorcycles = $this->motorcycleModel
            ->select('id, brand, model, license_number')
            ->where('customer_id', $customerId)
            ->orderBy('model')
            ->findAll();

        $data = array_map(function ($m) {
            return [
                'id' => (int)$m->id,
                'text' => "{$m->brand} {$m->model} - {$m->license_number}"
            ];
        }, $motorcycles);

        return $this->response->setJSON([
            'success' => true,
            'data' => $data
        ]);
    }
}
