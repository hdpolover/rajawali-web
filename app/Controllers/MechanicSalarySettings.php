<?php

namespace App\Controllers;

use App\Models\MechanicModel;
use App\Models\MechanicSalarySettingModel;

class MechanicSalarySettings extends BaseController
{
    protected $mechanicModel;
    protected $salarySettingModel;

    public function __construct()
    {
        $this->mechanicModel = new MechanicModel();
        $this->salarySettingModel = new MechanicSalarySettingModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Mechanic Salary Settings',
            'salarySettings' => $this->salarySettingModel->getSalarySettings()
        ];

        return $this->render('pages/mechanic-salary-settings/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Mechanic Salary Setting',
            'mechanics' => $this->mechanicModel->findAll()
        ];

        return $this->render('pages/mechanic-salary-settings/create', $data);
    }

    public function save()
    {
        // Validate required fields
        $rules = [
            'mechanic_id' => 'required|numeric',
            'percentage' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]',
            'status' => 'required|in_list[active,inactive]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Check if there's any active setting for this mechanic
        if ($this->request->getPost('status') === 'active') {
            $existingActive = $this->salarySettingModel->getActiveSetting($this->request->getPost('mechanic_id'));
            
            // If found, set it to inactive
            if ($existingActive) {
                $this->salarySettingModel->update($existingActive->id, ['status' => 'inactive']);
            }
        }

        // Save new salary setting
        $data = [
            'mechanic_id' => $this->request->getPost('mechanic_id'),
            'percentage' => $this->request->getPost('percentage'),
            'status' => $this->request->getPost('status'),
            'description' => $this->request->getPost('description'),
        ];

        $this->salarySettingModel->insert($data);

        return redirect()->to('settings/mechanic-salaries')->with('message', 'Mechanic salary setting has been added successfully.');
    }

    public function edit($id = null)
    {
        if ($id == null) {
            return redirect()->to('/mechanic-salary-settings')->with('error', 'Salary setting not found.');
        }

        $salarySetting = $this->salarySettingModel->find($id);

        if (!$salarySetting) {
            return redirect()->to('/mechanic-salary-settings')->with('error', 'Salary setting not found.');
        }

        $data = [
            'title' => 'Edit Mechanic Salary Setting',
            'salarySetting' => $salarySetting,
            'mechanics' => $this->mechanicModel->findAll(),
        ];

        return $this->render('pages/mechanic-salary-settings/edit', $data);
    }

    public function update($id = null)
    {
        if ($id == null) {
            return redirect()->to('/mechanic-salary-settings')->with('error', 'Salary setting not found.');
        }

        // Validate required fields
        $rules = [
            'mechanic_id' => 'required|numeric',
            'percentage' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]',
            'status' => 'required|in_list[active,inactive]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $salarySetting = $this->salarySettingModel->find($id);

        if (!$salarySetting) {
            return redirect()->to('/mechanic-salary-settings')->with('error', 'Salary setting not found.');
        }

        // Check if status is being set to active
        if ($this->request->getPost('status') === 'active') {
            $existingActive = $this->salarySettingModel->getActiveSetting($this->request->getPost('mechanic_id'));
            
            // If found and it's not the current record, set it to inactive
            if ($existingActive && $existingActive->id != $id) {
                $this->salarySettingModel->update($existingActive->id, ['status' => 'inactive']);
            }
        }

        // Update salary setting
        $data = [
            'mechanic_id' => $this->request->getPost('mechanic_id'),
            'percentage' => $this->request->getPost('percentage'),
            'status' => $this->request->getPost('status'),
            'description' => $this->request->getPost('description'),
        ];

        $this->salarySettingModel->update($id, $data);

        return redirect()->to('/mechanic-salary-settings')->with('message', 'Mechanic salary setting has been updated successfully.');
    }

    public function delete($id = null)
    {
        if ($id == null) {
            return redirect()->to('/mechanic-salary-settings')->with('error', 'Salary setting not found.');
        }

        $salarySetting = $this->salarySettingModel->find($id);

        if (!$salarySetting) {
            return redirect()->to('/mechanic-salary-settings')->with('error', 'Salary setting not found.');
        }

        $this->salarySettingModel->delete($id);

        return redirect()->to('/mechanic-salary-settings')->with('message', 'Mechanic salary setting has been deleted successfully.');
    }

    public function reports()
    {
        $data = [
            'title' => 'Mechanic Salary Reports',
            'mechanics' => $this->mechanicModel->findAll()
        ];

        return $this->render('pages/mechanic-salary-settings/reports', $data);
    }

    public function generateReport()
    {
        // Validate required fields
        $rules = [
            'start_date' => 'required|valid_date',
            'end_date' => 'required|valid_date',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');
        $mechanicId = $this->request->getPost('mechanic_id') ?: null;

        $report = $this->salarySettingModel->generateSalaryReport($startDate, $endDate, $mechanicId);

        $data = [
            'title' => 'Mechanic Salary Report',
            'report' => $report,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'mechanics' => $this->mechanicModel->findAll()
        ];

        return $this->render('pages/mechanic-salary-settings/report-results', $data);
    }

    public function printReport()
    {
        // Validate required fields
        $rules = [
            'start_date' => 'required|valid_date',
            'end_date' => 'required|valid_date',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');
        $mechanicId = $this->request->getPost('mechanic_id') ?: null;

        $report = $this->salarySettingModel->generateSalaryReport($startDate, $endDate, $mechanicId);

        $data = [
            'title' => 'Mechanic Salary Report',
            'report' => $report,
            'start_date' => $startDate,
            'end_date' => $endDate
        ];

        return $this->render('pages/mechanic-salary-settings/print-report', $data);
    }
}