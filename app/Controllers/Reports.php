<?php

namespace App\Controllers;

use App\Models\SalesModel;
use App\Models\MechanicModel;
use App\Models\MechanicSalarySettingModel;

class Reports extends BaseController
{
    protected $salesModel;
    protected $mechanicModel;
    protected $mechanicSalarySettingModel;

    public function __construct()
    {
        $this->salesModel = new SalesModel();
        $this->mechanicModel = new MechanicModel();
        $this->mechanicSalarySettingModel = new MechanicSalarySettingModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Reports Dashboard',
        ];

        return $this->render('pages/reports/index', $data);
    }

    public function sales()
    {
        $data = [
            'title' => 'Sales Reports',
        ];

        return $this->render('pages/reports/sales/index', $data);
    }

    public function generateSalesReport()
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
        $customerId = $this->request->getPost('customer_id') ?: null;

        $report = $this->salesModel->generateSalesReport($startDate, $endDate, $customerId);

        $data = [
            'title' => 'Sales Report',
            'report' => $report,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];

        return $this->render('pages/reports/sales/results', $data);
    }

    public function printSalesReport()
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
        $customerId = $this->request->getPost('customer_id') ?: null;

        $report = $this->salesModel->generateSalesReport($startDate, $endDate, $customerId);

        $data = [
            'title' => 'Sales Report',
            'report' => $report,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];

        return $this->render('pages/reports/sales/print', $data);
    }

    public function mechanicSalaries()
    {
        $data = [
            'title' => 'Mechanic Salary Reports',
            'mechanics' => $this->mechanicModel->findAll()
        ];

        return $this->render('pages/reports/mechanic-salaries/index', $data);
    }

    public function generateMechanicSalaryReport()
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

        $report = $this->mechanicSalarySettingModel->generateSalaryReport($startDate, $endDate, $mechanicId);

        $data = [
            'title' => 'Mechanic Salary Report',
            'report' => $report,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'mechanics' => $this->mechanicModel->findAll()
        ];

        return $this->render('pages/reports/mechanic-salaries/results', $data);
    }

    public function printMechanicSalaryReport()
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

        $report = $this->mechanicSalarySettingModel->generateSalaryReport($startDate, $endDate, $mechanicId);

        $data = [
            'title' => 'Mechanic Salary Report',
            'report' => $report,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];

        return $this->render('pages/reports/mechanic-salaries/print', $data);
    }
}