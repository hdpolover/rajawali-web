<?php
// app/Controllers/Dashboard.php

namespace App\Controllers;

use App\Models\MechanicModel;

class Mechanics extends BaseController
{
    protected $mechanicModel;

    public function __construct()
    {
        $this->mechanicModel = new MechanicModel();
    }

    public function index()
    {
        $data = [
            'title'       => 'Data Mekanik',
            'mechanics' => $this->mechanicModel->findAll(),
        ];

        return $this->render('pages/mechanic/index', $data);
    }

    // add function
    public function add()
    {
        // get form data
        $formData = [
            'name'   => $this->request->getPost('name'),
            'phone'  => $this->request->getPost('phone'),
        ];

        var_dump($formData);

        // validate form data
        if (!$this->validate($this->mechanicModel->getValidationRules())) {
            return redirect()->to('/mechanics')->withInput()->with('errors', $this->validator->getErrors());
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

        return redirect()->to('/mechanics');
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
            $mechanics = $this->mechanicModel->findAll();
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

}