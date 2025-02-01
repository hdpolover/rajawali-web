<?php
// app/Controllers/Dashboard.php

namespace App\Controllers;

use App\Models\SparePartTypeModel;

class SparePartTypes extends BaseController
{
    protected $sparePartTypeModel;

    public function __construct()
    {
        $this->sparePartTypeModel = new SparePartTypeModel();
    }

    public function index()
    {
        $data = [
            'title'       => 'Data Tipe Spare Part',
            'spare_part_types' => $this->sparePartTypeModel->findAll(),
        ];

        // var_dump($data);die;

        return $this->render('pages/spare_part_type/index', $data);
    }

    public function add()
    {
        // get form data
        $formData = [
            'name'   => $this->request->getPost('name'),
            'description'   => $this->request->getPost('description'),
        ];

        // validate form data
        if (!$this->validate($this->sparePartTypeModel->getValidationRules())) {
            return redirect()->to('/spare-part-types')->withInput()->with('errors', $this->validator->getErrors());
        }

        // insert data
        $savedData = $this->sparePartTypeModel->save($formData);

        // get data from the saved data

        if ($savedData) {
            // add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'spare_part_types',
                'action_type' => 'add',
                'old_value' => null,
                // get the new value name from the saved data
                'new_value' => $formData['name'],
            ];

            $this->activityLogModel->saveActivityLog($logData);

            // show success message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'success',
                'message' => 'Tipe Spare Part berhasil ditambahkan.'
            ]);

            return redirect()->to('/spare-part-types');
        } else {
            // show error message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Gagal menambahkan Tipe Spare Part.'
            ]);

            return redirect()->to('/spare-part-types');
        }
    }

    public function edit()
    {
        // get form data
        $formData = [
            'id'   => $this->request->getPost('id'),
            'name'   => $this->request->getPost('name'),
            'description'   => $this->request->getPost('description'),
        ];

        // validate form data
        if (!$this->validate($this->sparePartTypeModel->getValidationRules())) {
            return redirect()->to('/spare-part-types')->withInput()->with('errors', $this->validator->getErrors());
        }

        // get the old data
        $oldData = $this->sparePartTypeModel->find($formData['id']);

        // update data
        $updatedData = $this->sparePartTypeModel->save($formData);

        // get data from the saved data

        if ($updatedData) {
            // add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'spare_part_types',
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
                'message' => 'Tipe Spare Part berhasil diubah.'
            ]);

            return redirect()->to('/spare-part-types');
        } else {
            // show error message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Gagal mengubah Tipe Spare Part.'
            ]);

            return redirect()->to('/spare-part-types');
        }
    }

    public function delete()
    {
        // get form data
        $id = $this->request->getPost('id');

        // get the old data
        $oldData = $this->sparePartTypeModel->find($id);

        // delete data
        $deletedData = $this->sparePartTypeModel->delete($id);

        if ($deletedData) {
            // add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'spare_part_types',
                'action_type' => 'delete',
                // get the old value name from the old data
                'old_value' => $oldData->name,
                'new_value' => null,
            ];

            $this->activityLogModel->saveActivityLog($logData);

            // show success message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'success',
                'message' => 'Tipe Spare Part berhasil dihapus.'
            ]);

            return redirect()->to('/spare-part-types');
        } else {
            // show error message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Gagal menghapus Tipe Spare Part.'
            ]);

            return redirect()->to('/spare-part-types');
        }
    }
}
