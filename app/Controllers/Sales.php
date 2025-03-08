<?php

namespace App\Controllers;

use App\Models\SaleModel;
use App\Models\SparePartModel;
use App\Models\ServiceModel;
use App\Models\MechanicModel;
use App\Models\MotorcycleModel;
use App\Models\SparePartSaleModel;
use App\Models\ServiceSaleModel;
use App\Models\SparePartSaleDetailModel;
use App\Models\ServiceSaleDetailModel;
use App\Models\SparePartDetailModel;

class Sales extends BaseController
{
    protected $saleModel;
    protected $sparePartModel;
    protected $serviceModel;
    protected $mechanicModel;
    protected $motorcycleModel;
    protected $sparePartSaleModel;
    protected $serviceSaleModel;
    protected $sparePartSaleDetailModel;
    protected $serviceSaleDetailModel;
    protected $sparePartDetailModel;

    public function __construct()
    {
        // Load the sale model
        $this->saleModel = new SaleModel();
        // Load the spare part model
        $this->sparePartModel = new SparePartModel();
        // Load the service model
        $this->serviceModel = new ServiceModel();
        // Load the mechanic model
        $this->mechanicModel = new MechanicModel();
        // Load the motorcycle model
        $this->motorcycleModel = new MotorcycleModel();
        // Load the spare part sale model
        $this->sparePartSaleModel = new SparePartSaleModel();
        // Load the service sale model
        $this->serviceSaleModel = new ServiceSaleModel();
        // Load the spare part sale detail model
        $this->sparePartSaleDetailModel = new SparePartSaleDetailModel();
        // Load the service sale detail model
        $this->serviceSaleDetailModel = new ServiceSaleDetailModel();
        // Load the spare part detail model
        $this->sparePartDetailModel = new SparePartDetailModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Penjualan',
            // Get all sales data
            'sales' => $this->saleModel->getSales(),
        ];


        return $this->render('pages/transactions/sales/index', $data);
    }

    // save sale data
    public function save()
    {
        $postData = $this->request->getPost();

        // get sale type
        $saleType = $postData['sale_type'];

        $saleData = [];

        if ($saleType === 'complete') {
            // $sale data
            $saleData = [
                'sale_number' => $postData['sale_number'],
                'sale_date' => $postData['sale_date'],
                'customer_id' => $postData['customer_id'],
                'motorcycle_id' => $postData['motorcycle_id'],
                'admin_id' => session()->get('admin_id'),
                'discount' => $postData['discount'],
                'total' => $postData['total'],
                'description' => $postData['description'],
                'status' => 'pending',
            ];
        } else {
            // get form data complete
            $saleData = [
                'sale_number' => $postData['sale_number'],
                'sale_date' => $postData['sale_date'],
                'customer_id' => null,
                'motorcycle_id' => null,
                'admin_id' => session()->get('admin_id'),
                'discount' => $postData['discount'],
                'total' => $postData['total'],
                'description' => $postData['description'],
                'status' => 'pending',
            ];
        }

        // save sale
        $this->saleModel->save($saleData);

        // get the last inserted sale id
        $saleId = $this->saleModel->getInsertID();

        // decode spare parts data
        $spareParts = json_decode($postData['spare_parts'], true);

        // save sale details
        // check if spare parts data is not empty
        if (!empty($spareParts)) {
            $sparePartData = [];

            $sparePartTotal = 0;

            // loop through spare parts data
            foreach ($spareParts as $sparePart) {
                $sparePartData[] = [
                    'spare_part_id' => $sparePart['spare_part_id'],
                    'quantity' => $sparePart['quantity'],
                    'price' => $sparePart['price'],
                    'sub_total' => $sparePart['sub_total'],
                    'description' => $sparePart['description'],
                ];

                $sparePartTotal += $sparePart['sub_total'];
            }


            // save spare part sales
            $this->sparePartSaleModel->save([
                'sale_id' => $saleId,
                'total' => $sparePartTotal,
                'description' => '-',
            ]);

            // get the last inserted spare part sale id
            $sparePartSaleId = $this->sparePartSaleModel->getInsertID();

            // save spare part sale details
            foreach ($sparePartData as $sparePart) {
                $this->sparePartSaleDetailModel->save([
                    'spare_part_sale_id' => $sparePartSaleId,
                    'spare_part_id' => $sparePart['spare_part_id'],
                    'quantity' => $sparePart['quantity'],
                    'price' => $sparePart['price'],
                    'sub_total' => $sparePart['sub_total'],
                    'description' => $sparePart['description'],
                ]);

                // update spare part stock
                $this->sparePartDetailModel->updateStock($sparePart['spare_part_id'], $sparePart['quantity']);
            }
        }

        // decode services data
        $services = json_decode($postData['services'], true);

        // check if services data is not empty
        if (!empty($services)) {
            $serviceData = [];

            $serviceTotal = 0;

            // loop through services data
            foreach ($services as $service) {
                $serviceData[] = [
                    'service_id' => $service['service_id'],
                    'mechanic_id' => $service['mechanic_id'],
                    'price' => $service['price'],
                    'description' => $service['description'],
                    'sub_total' => $service['sub_total'],
                ];

                $serviceTotal += $service['sub_total'];
            }

            // save service sales
            $this->serviceSaleModel->save([
                'sale_id' => $saleId,
                'total' => $serviceTotal,
                'description' => '-',
            ]);

            // get the last inserted service sale id
            $serviceSaleId = $this->serviceSaleModel->getInsertID();

            // save service sale details
            foreach ($serviceData as $service) {
                $this->serviceSaleDetailModel->save([
                    'service_sale_id' => $serviceSaleId,
                    'service_id' => $service['service_id'],
                    'mechanic_id' => $service['mechanic_id'],
                    'price' => $service['price'],
                    'quantity' => 1,    // default quantity is 1
                    'sub_total' => $service['sub_total'],
                    'description' => $service['description'],
                ]);
            }
        }

        // show success message and redirect to the previous page. set alert session data
        session()->setFlashdata('alert', [
            'type' => 'success',
            'message' => 'Data penjualan berhasil ditambahkan',
        ]);

        // add activity log
        $logData = [
            'admin_id' => session()->get('admin_id'),
            'table_name' => 'sales',
            'action_type' => 'add',
            'old_value' => null,
            'new_value' => $postData['sale_date'],
        ];

        $this->activityLogModel->saveActivityLog($logData);

        return redirect()->to('/transactions/sales');
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Penjualan Baru',
            'spare_parts' => $this->sparePartModel->getWithPriceDetails(),
            'services' => $this->serviceModel->getServices(),
            'mechanics' => $this->mechanicModel->findAll(),
            'motorcycles' => $this->motorcycleModel->getMotorcycles(),
        ];

        return $this->render('pages/transactions/sales/new', $data);
    }
}
