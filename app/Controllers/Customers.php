<?php
// app/Controllers/Dashboard.php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customers extends BaseController
{
    protected $customerModel;

    public function __construct()
    {
        $this->customerModel = new CustomerModel();
    }

    public function index()
    {
        $data = [
            'title'       => 'Data Pelanggan',
            'customers' => $this->customerModel->findAll(), // sort by name
        ];

        return $this->render('pages/customer/index', $data);
    }

    public function fetch()
    {
        $response = array();

        if ($this->request->getPost('name')) {

            $searchTerm = $this->request->getPost('name');

            $customers = $this->customerModel->select('id,name')
                ->like('name', $searchTerm)
                ->orderBy('name')
                ->findAll();
        } else {
            $customers = $this->customerModel->findAll();
        }

        // return data as data with id and name
        $data = [];

        foreach ($customers as $c) {
            $data[] = [
                // convert id to int
                'id' => (int)$c->id,
                'text' => $c->name
            ];
        }

        $response['data'] = $data;

        return $this->response->setJSON($response);
    }

    // add function
    public function add()
    {
        // get form data
        $formData = [
            'name'   => $this->request->getPost('name'),
            'phone'  => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address')
        ];

        // validate form data
        if (!$this->validate($this->customerModel->getValidationRules())) {
            return redirect()->to('/master-data/customers')->withInput()->with('errors', $this->validator->getErrors());
        }

        // insert data
        $savedData = $this->customerModel->save($formData);

        if ($savedData) {
            // add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'customers',
                'action_type' => 'add',
                'old_value' => null,
                // get the new value name from the saved data
                'new_value' => $formData['name'],
            ];

            $this->activityLogModel->saveActivityLog($logData);

            // show success message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'success',
                'message' => 'Data pelanggan berhasil ditambahkan'
            ]);
        } else {
            // show error message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Data pelanggan gagal ditambahkan'
            ]);
        }

        return redirect()->to('/master-data/customers');
    }

    // add function
    public function addAlt()
    {
        $response = ['success' => false, 'message' => ''];

        try {
            // Get form data
            $formData = [
                'name'    => $this->request->getPost('name'),
                'phone'   => $this->request->getPost('phone'),
                'address' => $this->request->getPost('address')
            ];

            // Validate form data
            if (!$this->validate($this->customerModel->getValidationRules())) {
                $response['message'] = implode(', ', $this->validator->getErrors());
                return $this->response->setJSON($response);
            }

            // Save data
            $saved = $this->customerModel->save($formData);

            if ($saved) {
                // Add activity log
                $logData = [
                    'admin_id' => session()->get('admin_id'),
                    'table_name' => 'customers',
                    'action_type' => 'add',
                    'old_value' => null,
                    'new_value' => $formData['name'],
                ];

                $this->activityLogModel->saveActivityLog($logData);

                $response['success'] = true;
                $response['message'] = 'Berhasil menyimpan data pelanggan';
            } else {
                $response['message'] = 'Gagal menyimpan data pelanggan';
            }
        } catch (\Exception $e) {
            $response['message'] = 'Error: ' . $e->getMessage();
        }

        return $this->response->setJSON($response);
    }

    // edit function
    public function edit()
    {
        // get form data
        $formData = [
            'id'     => $this->request->getPost('id'),
            'name'   => $this->request->getPost('name'),
            'phone'  => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address')
        ];

        // validate form data
        if (!$this->validate($this->customerModel->getValidationRules())) {
            return redirect()->to('/customers')->withInput()->with('errors', $this->validator->getErrors());
        }

        // get the old data
        $oldData = $this->customerModel->find($formData['id']);

        // update data
        $updatedData = $this->customerModel->save($formData);

        if ($updatedData) {
            // add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'customers',
                'action_type' => 'edit',
                // get the old value name from the old data
                'old_value' => $oldData['name'],
                // get the new value name from the saved data
                'new_value' => $formData['name'],
            ];

            $this->activityLogModel->saveActivityLog($logData);

            // show success message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'success',
                'message' => 'Data pelanggan berhasil diubah'
            ]);
        } else {
            // show error message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Data pelanggan gagal diubah'
            ]);
        }

        return redirect()->to('/master-data/customers');
    }

    // delete function
    public function delete()
    {
        // get customer id from form data
        $customerId = $this->request->getPost('id');

        // get the old data
        $oldData = $this->customerModel->find($customerId);

        // delete data
        $deletedData = $this->customerModel->delete($customerId);

        if ($deletedData) {
            // add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'customers',
                'action_type' => 'delete',
                // get the old value name from the old data
                'old_value' => $oldData['name'],
                'new_value' => null,
            ];

            $this->activityLogModel->saveActivityLog($logData);

            // show success message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'success',
                'message' => 'Data pelanggan berhasil dihapus'
            ]);
        } else {
            // show error message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Data pelanggan gagal dihapus'
            ]);
        }

        return redirect()->to('/master-data/customers');
    }
}
