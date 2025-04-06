<?php
// app/Controllers/Dashboard.php

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
    }

    public function index()
    {
        $data = [
            'title'       => 'Data Motor Pelanggan',
            'motorcycles' => $this->motorcycleModel->findAll(),
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
