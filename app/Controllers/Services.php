<?php
// app/Controllers/Dashboard.php

namespace App\Controllers;

use App\Models\ServiceModel;
use App\Models\ServicePriceModel;

class Services extends BaseController
{
    protected $serviceModel;
    protected $servicePriceModel;

    public function __construct()
    {
        $this->serviceModel = new ServiceModel();
        $this->servicePriceModel = new ServicePriceModel();
    }

    public function index()
    {
        $data = [
            'title'       => 'Data Servis',
            'services' => $this->serviceModel->getServices(),
        ];

        return $this->render('pages/service/index', $data);
    }

    // add function
    public function add()
    {
        // Add detailed logging for debugging
        log_message('debug', 'Services add method called');
        log_message('debug', 'POST data: ' . json_encode($this->request->getPost()));

        // get form data for service table
        $formData = [
            'name' => $this->request->getPost('service_name'),
            'description' => $this->request->getPost('description'),
            'difficulty' => $this->request->getPost('difficulty')
        ];

        // Get the price for service_prices table
        $price = $this->request->getPost('price');

        // validate service form data
        if (!$this->validate($this->serviceModel->getValidationRules())) {
            log_message('debug', 'Validation errors: ' . json_encode($this->validator->getErrors()));
            return redirect()->to('/master-data/services')->withInput()->with('errors', $this->validator->getErrors());
        }

        // Make sure price isn't empty
        if (empty($price)) {
            log_message('debug', 'Price is empty');
            session()->setFlashdata('errors', ['price' => 'Harga harus diisi']);
            return redirect()->to('/master-data/services')->withInput();
        }

        // Use the model method to save both service and price
        $result = $this->serviceModel->saveWithPrice($formData, $price);

        if ($result) {
            log_message('debug', 'Service saved successfully with ID: ' . $result);
            // add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'services',
                'action_type' => 'add',
                'old_value' => null,
                'new_value' => $formData['name'],
            ];

            $this->activityLogModel->saveActivityLog($logData);

            // show success message and redirect
            session()->setFlashdata('alert', [
                'type' => 'success',
                'message' => 'Data servis berhasil ditambahkan.'
            ]);

            return redirect()->to('/master-data/services');
        } else {
            log_message('error', 'Failed to save service with price');
            // show error message and redirect
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Gagal menambahkan data servis.'
            ]);

            return redirect()->to('/master-data/services');
        }
    }

    // fetch
    public function fetch()
    {
        $response = array();

        $searchTerm = $this->request->getPost('name');

        if ($searchTerm) {
            $services = $this->serviceModel->select('id,name')
                ->like('name', $searchTerm)
                ->orderBy('name')
                ->findAll();
        } else {
            $services = $this->serviceModel->findAll();
        }

        // return data as data with id and name
        $data = [];

        foreach ($services as $service) {
            $data[] = [
                // convert id to int
                'id' => (int)$service->id,
                'text' => $service->name,
            ];
        }

        $response['data'] = $data;

        return $this->response->setJSON($response);
    }
}