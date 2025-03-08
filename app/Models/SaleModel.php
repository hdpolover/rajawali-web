<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\SalePaymentDetailModel;

class SaleModel extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';

    protected $allowedFields = [
        'customer_id',
        'motorcycle_id',
        'sale_number',
        'description',
        'admin_id',
        'discount',
        'total',
        'status',
        'sale_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'sale_number' => 'required',
        'admin_id' => 'required',
        'discount' => 'required|numeric',
        'total' => 'required|numeric',
        'status' => 'required',
        'sale_date' => 'required'
    ];

    protected $validationMessages = [
        'customer_id' => [
            'required' => 'Customer wajib diisi'
        ],
        'motorcycle_id' => [
            'required' => 'Motor wajib diisi'
        ],
        'sale_number' => [
            'required' => 'Nomor penjualan wajib diisi'
        ],
        'admin_id' => [
            'required' => 'Admin wajib diisi'
        ],
        'discount' => [
            'required' => 'Diskon wajib diisi',
            'numeric' => 'Diskon harus berupa angka'
        ],
        'total' => [
            'required' => 'Total wajib diisi',
            'numeric' => 'Total harus berupa angka'
        ],
        'status' => [
            'required' => 'Status wajib diisi'
        ],
        'sale_date' => [
            'required' => 'Tanggal penjualan wajib diisi'
        ]
    ];

    public function getSalesSummaryToday()
    {
        $today = date('Y-m-d'); // Get today's date

        return $this->select('status, COUNT(id) as count')
            ->where("DATE(created_at)", $today)
            ->groupBy('status')
            ->findAll();
    }

    public function getTotalSalesToday()
    {
        $today = date('Y-m-d');

        return $this->selectSum('total')
            ->where("DATE(created_at)", $today)
            ->where("status", "completed") // Only count completed sales for revenue
            ->first();
    }

    public function getSales($id = null)
    {
        if ($id == null) {
            // builder
            $builder = $this->db->table('sales');
            // get sales
            $builder->select('sales.*');

            // Execute the query and get the result as an array of objects
            $saleResult = $builder->get()->getResult();

            // create an array of sale entities
            $sales = [];

            // loop through the results and create sale entities
            foreach ($saleResult as $sale) {

                // get the customer entity
                $customerModel = new CustomerModel();
                $customer = $customerModel->where('id', $sale->customer_id)->first();

                if ($customer) {
                    $sale->customer = $customer;
                } else {
                    $sale->customer = null;
                }

                // get the motorcycle entity
                $motorcycleModel = new MotorcycleModel();
                $motorcycle = $motorcycleModel->where('id', $sale->motorcycle_id)->first();
                
                if ($motorcycle) {
                    $sale->motorcycle = $motorcycle;
                } else {
                    $sale->motorcycle = null;
                }

                // get the admin entity
                $adminModel = new AdminModel();
                $admin = $adminModel->find($sale->admin_id);
                $sale->admin = $admin;

                // get spare part sales
                $sparePartSaleModel = new SparePartSaleModel();

                // get 1 spare part sale for this sale and return as object
                $sparePartSale = $sparePartSaleModel->where('sale_id', $sale->id)->first();

                // get spare part sale details
                $sparePartSaleDetailModel = new SparePartSaleDetailModel();

                $sparePartSaleDetails = $sparePartSaleDetailModel->where('spare_part_sale_id', $sparePartSale->id)->findAll();

                for ($i = 0; $i < count($sparePartSaleDetails); $i++) {
                    $sparePartModel = new SparePartModel();
                    $sparePart = $sparePartModel->find($sparePartSaleDetails[$i]->spare_part_id);
                    $sparePartSaleDetails[$i]->spare_part = $sparePart;
                }

                // set the spare part sale details
                $sparePartSale->details = $sparePartSaleDetails;

                // set the spare part sales
                $sale->spare_part_sale = $sparePartSale;

                // get service sales
                $serviceSaleModel = new ServiceSaleModel();

                $serviceSales = $serviceSaleModel->where('sale_id', $sale->id)->first();

                if ($serviceSales) {
                    // get service sale details
                    $serviceSaleDetailModel = new ServiceSaleDetailModel();

                    $serviceSaleDetails = $serviceSaleDetailModel->where('service_sale_id', $serviceSales->id)->findAll();

                    for ($i = 0; $i < count($serviceSaleDetails); $i++) {
                        $serviceModel = new ServiceModel();
                        $service = $serviceModel->find($serviceSaleDetails[$i]->service_id);
                        $serviceSaleDetails[$i]->service = $service;

                        $mechanicModel = new MechanicModel();
                        $mechanic = $mechanicModel->find($serviceSaleDetails[$i]->mechanic_id);
                        $serviceSaleDetails[$i]->mechanic = $mechanic;  
                    }

                    // set the service sale details
                    $serviceSales->details = $serviceSaleDetails;

                    // set the service sales
                    $sale->service_sales = $serviceSales;
                } else {
                    $sale->service_sales = null;
                }   

                // get the payment entity
                $salePaymentModel = new SalePaymentModel();

                $payment = $salePaymentModel->where('sale_id', $sale->id)->first();

                if ($payment) {
                    // get the payment details
                    $salePaymentDetailModel = new SalePaymentDetailModel();

                    $paymentDetails = $salePaymentDetailModel->where('sale_payment_id', $payment->id)->findAll();

                    // set the payment details
                    $payment->details = $paymentDetails;

                    // set the payment
                    $sale->payment = $payment;
                } else {
                    $sale->payment = null;
                }

                // add the sale entity to the array
                $sales[] = $sale;
            }

            return $sales;
        } else {
            return $this->where('id', $id)->first();
        }
    }
}
