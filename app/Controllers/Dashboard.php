<?php
// app/Controllers/Dashboard.php

namespace App\Controllers;

use App\Models\SaleModel;

class Dashboard extends BaseController
{
    protected $saleModel;

    // constructor
    public function __construct()
    {
        // load the required model
        $this->saleModel = new SaleModel();
    }
    public function index()
    {
        $salesData = [];

        // Get count of sales statuses
        $salesSummary = $this->saleModel->getSalesSummaryToday();
        $salesData = [
            'pending' => 0,
            'process' => 0,
            'completed' => 0,
            'total' => 0,
        ];

        foreach ($salesSummary as $row) {
            $status = strtolower($row->status); // Convert to lowercase
            if (array_key_exists($status, $salesData)) {
                $salesData[$status] = $row->count;
            }

            $salesData['total'] += $row->count;
        }

        // Get total sales amount today
        // $totalSales = $this->saleModel->getTotalSalesToday();
        // $salesData['total_revenue'] = $totalSales->total ?? 0;

        $data = [
            'title'       => 'Dashboard',
            'salesData'   => $salesData,
        ];

        return $this->render('pages/dashboard/dashboard', $data);
    }
}