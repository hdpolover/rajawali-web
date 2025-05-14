<?php
// app/Controllers/Dashboard.php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\ActivityLogModel;

class Customers extends BaseController
{
    protected $customerModel;
    protected $activityLogModel;

    public function __construct()
    {
        $this->customerModel = new CustomerModel();
        $this->activityLogModel = new ActivityLogModel();
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
        $validation = \Config\Services::validation();

        // Set validation rules
        $validation->setRules($this->customerModel->getValidationRules());

        // Validate
        if (!$validation->run($formData)) {
            return redirect()->to('/master-data/customers')->withInput()->with('errors', $validation->getErrors());
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
    }    // add function
    public function addAlt()
    {
        $response = ['success' => false, 'message' => ''];

        try {
            // Log raw POST data for debugging
            log_message('debug', 'Customer addAlt POST data: ' . json_encode($this->request->getPost()));
            
            // Get form data
            $formData = [
                'name'    => $this->request->getPost('name'),
                'phone'   => $this->request->getPost('phone'),
                'address' => $this->request->getPost('address')
            ];

            // Validate form data
            $validation = \Config\Services::validation();

            // Set validation rules
            $validation->setRules($this->customerModel->getValidationRules());            // Validate
            if (!$validation->run($formData)) {
                $response['message'] = implode(', ', $validation->getErrors());
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

                // Get the newly inserted customer data
                $newCustomer = $this->customerModel->find($this->customerModel->getInsertID());                $response['success'] = true;
                $response['message'] = 'Berhasil menyimpan data pelanggan';
                $response['data'] = [
                    'id' => (int)$newCustomer->id,
                    'name' => $newCustomer->name,
                    'phone' => $newCustomer->phone,
                    'address' => $newCustomer->address
                ];
            } else {
                $response['success'] = false;
                $response['message'] = 'Gagal menyimpan data pelanggan';
            }

            return $this->response->setJSON($response);
        } catch (\Exception $e) {
            $response['success'] = false;
            $response['message'] = 'Error: ' . $e->getMessage();
            return $this->response->setJSON($response);
        }
    }

    // edit function
    public function edit()
    {
        // get form data
        $id = $this->request->getPost('id');
        $formData = [
            'id'     => $id,
            'name'   => $this->request->getPost('name'),
            'phone'  => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address')
        ];

        // validate form data
        $validation = \Config\Services::validation();

        // Set validation rules
        $validation->setRules($this->customerModel->getValidationRules());

        // Validate
        if (!$validation->run($formData)) {
            return redirect()->to('/master-data/customers')->withInput()->with('errors', $validation->getErrors());
        }

        // get the old data
        $oldData = $this->customerModel->find($id);

        // update data
        $updatedData = $this->customerModel->save($formData);

        if ($updatedData) {
            // add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'customers',
                'action_type' => 'edit',
                // get the old value name from the old data
                'old_value' => $oldData->name,
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
        $id = $this->request->getPost('id');

        // Validate that the ID exists
        $customer = $this->customerModel->find($id);
        if (!$customer) {
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Data pelanggan tidak ditemukan.'
            ]);
            return redirect()->to('/master-data/customers');
        }

        // delete data
        $deletedData = $this->customerModel->delete($id);

        if ($deletedData) {
            // add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'customers',
                'action_type' => 'delete',
                // get the old value name from the old data
                'old_value' => $customer->name,
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
    }    // archive methods
    public function archived()
    {
        $data = [
            'title'     => 'Data Pelanggan Diarsipkan',
            'customers' => $this->customerModel->onlyDeleted()->findAll(),
        ];

        return $this->render('pages/customer/archived', $data);
    }

    // restore method
    public function restore($id)
    {
        // Get customer data
        $customer = $this->customerModel->onlyDeleted()->find($id);

        if (!$customer) {
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Data pelanggan tidak ditemukan.'
            ]);
            return redirect()->to('/master-data/customers');
        }

        // Restore customer (remove the deletion mark)
        $this->customerModel->update($id, ['deleted_at' => null]);

        // Add activity log
        $logData = [
            'admin_id' => session()->get('admin_id'),
            'table_name' => 'customers',
            'action_type' => 'edit',
            'old_value' => 'Diarsipkan: ' . $customer->name,
            'new_value' => 'Dipulihkan: ' . $customer->name,
        ];

        $this->activityLogModel->saveActivityLog($logData);

        session()->setFlashdata('alert', [
            'type' => 'success',
            'message' => 'Data pelanggan berhasil dipulihkan.'
        ]);

        return redirect()->to('/master-data/customers');
    }
}
