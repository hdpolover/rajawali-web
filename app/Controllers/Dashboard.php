<?php
// app/Controllers/Dashboard.php

namespace App\Controllers;

use App\Models\SaleModel;
use App\Models\SparePartModel;
use App\Models\ServiceModel;
use App\Models\MechanicModel;
use App\Models\SparePartSaleDetailModel;
use App\Models\ServiceSaleDetailModel;
use App\Models\CustomerModel;
use App\Models\DashboardModel;

class Dashboard extends BaseController
{
    
    protected $dashboardModel;

    // constructor
    public function __construct()
    {
        // load the required models
       
        $this->dashboardModel = new DashboardModel();
    }
    
    public function index()
    {
        $salesData = [];

        // Get count of sales statuses
        $salesSummary = $this->dashboardModel->getSalesSummaryToday();
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
        $totalSales = $this->dashboardModel->getTotalSalesToday();
        $salesData['total_revenue'] = $totalSales->total ?? 0;
        
        // Get top selling spare parts
        $topSparePartSales = $this->dashboardModel->getTopSellingSparePartsToday(5);
        
        // Get popular services
        $popularServices = $this->dashboardModel->getPopularServicesToday(5);
        
        // Get top mechanics performance
        $topMechanics = $this->dashboardModel->getTopMechanicsToday(5);
        
        // Get monthly sales trend
        $monthlySalesTrend = $this->dashboardModel->getMonthlySalesTrend();
        
        // Get low stock spare parts
        $lowStockSpareParts = $this->dashboardModel->getLowStockSpareParts();
        
        // Get customer retention stats
        $customerRetention = $this->dashboardModel->getCustomerRetentionStats();
        
        // Get service type distribution
        $serviceDistribution = $this->dashboardModel->getServiceTypeDistribution();

        $data = [
            'title'               => 'Dashboard',
            'salesData'           => $salesData,
            'topSparePartSales'   => $topSparePartSales,
            'popularServices'     => $popularServices,
            'topMechanics'        => $topMechanics,
            'monthlySalesTrend'   => $monthlySalesTrend,
            'lowStockSpareParts'  => $lowStockSpareParts,
            'customerRetention'   => $customerRetention,
            'serviceDistribution' => $serviceDistribution,
        ];

        return $this->render('pages/dashboard/dashboard', $data);
    }
}