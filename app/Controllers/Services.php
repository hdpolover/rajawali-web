<?php
// app/Controllers/Dashboard.php

namespace App\Controllers;

use App\Models\ServiceModel;

class Services extends BaseController
{
    protected $serviceModel;

    public function __construct()
    {
        $this->serviceModel = new ServiceModel();
    }

    public function index()
    {
        $data = [
            'title'       => 'Data Servis',
            'services' => $this->serviceModel->get_service_with_prices(),
        ];

        return $this->render('pages/service/index', $data);
    }

    // add function
    public function add()
    {
        // get form data
        $formData = [
            'name'   => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'difficulty' => $this->request->getPost('difficulty')
        ];

        // validate form data
        if (!$this->validate($this->serviceModel->getValidationRules())) {
            return redirect()->to('/services')->withInput()->with('errors', $this->validator->getErrors());
        }

        // insert data
        $savedData = $this->serviceModel->save($formData);

        if ($savedData) {
            // add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'services',
                'action_type' => 'add',
                'old_value' => null,
                // get the new value name from the saved data
                'new_value' => $formData['name'],
            ];

            $this->activityLogModel->saveActivityLog($logData);

            // show success message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'success',
                'message' => 'Data servis berhasil ditambahkan.'
            ]);

            return redirect()->to('/services');
        } else {
            // show error message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Gagal menambahkan data servis.'
            ]);

            return redirect()->to(previous_url());
        }
    }

}