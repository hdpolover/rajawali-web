<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\CustomerModel;
use App\Models\MotorcycleModel;
use App\Models\AdminModel;
use App\Models\SparePartModel;
use App\Models\ServiceModel;
use App\Models\MechanicModel;
use App\Models\SparePartSaleModel;
use App\Models\SparePartSaleDetailModel;
use App\Models\ServiceSaleModel;
use App\Models\ServiceSaleDetailModel;
use App\Models\SalePaymentModel;
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
            // Get all sales
            $builder = $this->db->table('sales');
            $builder->select('sales.*');
            $builder->orderBy('created_at', 'DESC');
            $saleResults = $builder->get()->getResult();

            $sales = [];

            foreach ($saleResults as $sale) {
                // Get customer data
                $customerModel = new CustomerModel();
                if ($sale->customer_id) {
                    $customer = $customerModel->find($sale->customer_id);
                    $sale->customer = $customer;
                } else {
                    $sale->customer = null;
                }

                // Get motorcycle data
                $motorcycleModel = new MotorcycleModel();
                if ($sale->motorcycle_id) {
                    $motorcycle = $motorcycleModel->find($sale->motorcycle_id);
                    $sale->motorcycle = $motorcycle;
                } else {
                    $sale->motorcycle = null;
                }

                // Get admin data
                $adminModel = new AdminModel();
                if ($sale->admin_id) {
                    $admin = $adminModel->find($sale->admin_id);
                    $sale->admin = $admin;
                } else {
                    $sale->admin = null;
                }

                // Get spare part sales data
                $sparePartSaleModel = new SparePartSaleModel();
                $sparePartSale = $sparePartSaleModel->where('sale_id', $sale->id)->first();
                
                if ($sparePartSale) {
                    $sparePartSaleDetailModel = new SparePartSaleDetailModel();
                    $sparePartDetails = $sparePartSaleDetailModel->where('spare_part_sale_id', $sparePartSale->id)->findAll();

                    // Get spare part data for each detail
                    foreach ($sparePartDetails as $detail) {
                        $sparePartModel = new SparePartModel();
                        $sparePart = $sparePartModel->find($detail->spare_part_id);
                        $detail->spare_part = $sparePart;
                    }

                    $sparePartSale->details = $sparePartDetails;
                    $sale->spare_part_sale = $sparePartSale;
                } else {
                    $sale->spare_part_sale = null;
                }

                // Get service sales data
                $serviceSaleModel = new ServiceSaleModel();
                $serviceSale = $serviceSaleModel->where('sale_id', $sale->id)->first();

                if ($serviceSale) {
                    $serviceSaleDetailModel = new ServiceSaleDetailModel();
                    $serviceDetails = $serviceSaleDetailModel->where('service_sale_id', $serviceSale->id)->findAll();

                    // Get service and mechanic data for each detail
                    foreach ($serviceDetails as $detail) {
                        $serviceModel = new ServiceModel();
                        $service = $serviceModel->find($detail->service_id);
                        $detail->service = $service;

                        $mechanicModel = new MechanicModel();
                        $mechanic = $mechanicModel->find($detail->mechanic_id);
                        $detail->mechanic = $mechanic;
                    }

                    $serviceSale->details = $serviceDetails;
                    $sale->service_sale = $serviceSale;
                } else {
                    $sale->service_sale = null;
                }

                // Get payment data
                $paymentModel = new SalePaymentModel();
                $payment = $paymentModel->where('sale_id', $sale->id)->first();

                if ($payment) {
                    $paymentDetailModel = new SalePaymentDetailModel();
                    $paymentDetails = $paymentDetailModel->where('sale_payment_id', $payment->id)->findAll();

                    // Get payment method details
                    foreach ($paymentDetails as $detail) {
                        // Set default payment method if not set
                        if (!isset($detail->payment_method)) {
                            $detail->payment_method = 'cash';
                        }
                    }

                    $payment->details = $paymentDetails;
                    $sale->payment = $payment;
                } else {
                    $sale->payment = null;
                }

                $sales[] = $sale;
            }

            return $sales;
        } else {
            // Get specific sale by ID with all relations
            $sale = $this->find($id);
            if (!$sale) {
                return null;
            }

            // Get customer data
            $customerModel = new CustomerModel();
            if ($sale->customer_id) {
                $customer = $customerModel->find($sale->customer_id);
                $sale->customer = $customer;
            } else {
                $sale->customer = null;
            }

            // Get motorcycle data
            $motorcycleModel = new MotorcycleModel();
            if ($sale->motorcycle_id) {
                $motorcycle = $motorcycleModel->find($sale->motorcycle_id);
                $sale->motorcycle = $motorcycle;
            } else {
                $sale->motorcycle = null;
            }

            // Get admin data
            $adminModel = new AdminModel();
            if ($sale->admin_id) {
                $admin = $adminModel->find($sale->admin_id);
                $sale->admin = $admin;
            } else {
                $sale->admin = null;
            }

            // Get spare part sales data
            $sparePartSaleModel = new SparePartSaleModel();
            $sparePartSale = $sparePartSaleModel->where('sale_id', $sale->id)->first();

            if ($sparePartSale) {
                $sparePartSaleDetailModel = new SparePartSaleDetailModel();
                $sparePartDetails = $sparePartSaleDetailModel->where('spare_part_sale_id', $sparePartSale->id)->findAll();

                // Get spare part data for each detail
                foreach ($sparePartDetails as $detail) {
                    $sparePartModel = new SparePartModel();
                    $sparePart = $sparePartModel->find($detail->spare_part_id);
                    $detail->spare_part = $sparePart;
                }

                $sparePartSale->details = $sparePartDetails;
                $sale->spare_part_sale = $sparePartSale;
            } else {
                $sale->spare_part_sale = null;
            }

            // Get service sales data
            $serviceSaleModel = new ServiceSaleModel();
            $serviceSale = $serviceSaleModel->where('sale_id', $sale->id)->first();

            if ($serviceSale) {
                $serviceSaleDetailModel = new ServiceSaleDetailModel();
                $serviceDetails = $serviceSaleDetailModel->where('service_sale_id', $serviceSale->id)->findAll();

                // Get service and mechanic data for each detail
                foreach ($serviceDetails as $detail) {
                    $serviceModel = new ServiceModel();
                    $service = $serviceModel->find($detail->service_id);
                    $detail->service = $service;

                    $mechanicModel = new MechanicModel();
                    $mechanic = $mechanicModel->find($detail->mechanic_id);
                    $detail->mechanic = $mechanic;
                }

                $serviceSale->details = $serviceDetails;
                $sale->service_sale = $serviceSale;
            } else {
                $sale->service_sale = null;
            }

            // Get payment data
            $paymentModel = new SalePaymentModel();
            $payment = $paymentModel->where('sale_id', $sale->id)->first();

            if ($payment) {
                $paymentDetailModel = new SalePaymentDetailModel();
                $paymentDetails = $paymentDetailModel->where('sale_payment_id', $payment->id)->findAll();

                // Get payment method details
                foreach ($paymentDetails as $detail) {
                    // Set default payment method if not set
                    if (!isset($detail->payment_method)) {
                        $detail->payment_method = 'cash';
                    }
                }

                $payment->details = $paymentDetails;
                $sale->payment = $payment;
            } else {
                $sale->payment = null;
            }

            return $sale;
        }
    }
}
