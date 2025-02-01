<?php

namespace App\Controllers;

use App\Models\SaleModel;
use App\Models\SparePartModel;

class Sales extends BaseController
{
    protected $saleModel;
    protected $sparePartModel;

    public function __construct()
    {
        // Load the sale model
        $this->saleModel = new SaleModel();
        // Load the spare part model
        $this->sparePartModel = new SparePartModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Penjualan',
            // Get all sales data
            'sales' => $this->saleModel->getSales(),
        ];

        // var_dump($data['sales']);

        return $this->render('pages/transactions/sales/index', $data);
    }

    public function add() {
        $data = [
            'title' => 'Tambah Penjualan Baru',
            'spare_parts' => $this->sparePartModel->getWithPriceDetails(),
        ];

        return $this->render('pages/transactions/sales/new', $data);
    }
}