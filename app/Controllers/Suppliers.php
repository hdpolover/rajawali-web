<?php
// app/Controllers/Dashboard.php

namespace App\Controllers;

use App\Models\SupplierModel;

class Suppliers extends BaseController
{

    protected $supplierModel;

    public function __construct()
    {
        $this->supplierModel = new SupplierModel();
    }

    public function index()
    {
        $data = [
            'title'       => 'Data Supplier',
            'suppliers' => $this->supplierModel->findAll(),
        ];

        return $this->render('pages/supplier/index', $data);
    }

    public function fetch()
    {
        $response = array();

        if ($this->request->getPost('name')) {

            $searchTerm = $this->request->getPost('name');

            $suppliers = $this->supplierModel->select('id,name')
                ->like('name', $searchTerm)
                ->orderBy('name')
                ->findAll();
        } else {
            $suppliers = $this->supplierModel->findAll();
        }

        // return data as data with id and name
        $data = [];

        foreach ($suppliers as $supplier) {
            $data[] = [
                // convert id to int
                'id' => (int)$supplier->id,
                'text' => $supplier->name
            ];
        }

        $response['data'] = $data;

        return $this->response->setJSON($response);
        
    }

    public function add()
    {
        // get form data
        $formData = [
            'name'   => $this->request->getPost('name'),
            'phone_number'  => $this->request->getPost('phone_number'),
            'address' => $this->request->getPost('address')
        ];

        // validate form data
        if (!$this->validate($this->supplierModel->getValidationRules())) {
            return redirect()->to('/suppliers')->withInput()->with('errors', $this->validator->getErrors());
        }

        // insert data
        $savedData = $this->supplierModel->save($formData);

        if ($savedData) {
            // add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'suppliers',
                'action_type' => 'add',
                'old_value' => null,
                // get the new value name from the saved data
                'new_value' => $formData['name'],
            ];

            $this->activityLogModel->saveActivityLog($logData);

            // show success message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'success',
                'message' => 'Supplier berhasil ditambahkan.'
            ]);

            return redirect()->to('/suppliers');
        } else {
            // show error message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Gagal menambahkan supplier.'
            ]);

            return redirect()->to('/suppliers');
        }
    }

    public function edit()
    {
        // get form data
        $formData = [
            'id' => $this->request->getPost('id'),
            'name' => $this->request->getPost('name'),
            'phone_number' => $this->request->getPost('phone_number'),
            'address' => $this->request->getPost('address')
        ];

        // validate form data
        if (!$this->validate($this->supplierModel->getValidationRules())) {
            return redirect()->to('/suppliers')->withInput()->with('errors', $this->validator->getErrors());
        }

        // get the old data
        $oldData = $this->supplierModel->find($formData['id']);

        // update data
        $updatedData = $this->supplierModel->save($formData);

        if ($updatedData) {
            // add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'suppliers',
                'action_type' => 'edit',
                'old_value' => $oldData->name,
                'new_value' => $formData['name'],
            ];

            $this->activityLogModel->saveActivityLog($logData);

            // show success message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'success',
                'message' => 'Supplier berhasil diubah.'
            ]);

            return redirect()->to('/suppliers');
        } else {
            // show error message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Gagal mengubah supplier.'
            ]);

            return redirect()->to('/suppliers');
        }
    }

    public function delete()
    {
        // get supplier id from form data
        $id = $this->request->getPost('delete_id');

        $formData = [
            'deleted_at' => date('Y-m-d H:i:s')
        ];
        // delete supplier data from database by updating the deleted_at field, but dont actually delete it
        $deleteSupplier = $this->supplierModel->update($id, $formData);

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
