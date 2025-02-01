<?php

namespace App\Models;

use App\Entities\Sale;
use CodeIgniter\Model;

class SaleModel extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = Sale::class;

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
        'customer_id' => 'required',
        'motorcycle_id' => 'required',
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

    public function getSales($id = null) {
        if ($id == null) {
            // builder
            $builder = $this->db->table('sales');
            // get sales
            $builder->select('sales.*');

            // Execute the query and get the result as an array of objects
            $saleResult = $builder->get()->getResultArray();

            // create an array of sale entities
            $sales = [];

            // loop through the results and create sale entities
            foreach ($saleResult as $data) {
                // get the sale entity
                $sale = new Sale($data);

                // get the customer entity
                $customerModel = new CustomerModel();
                $customer = $customerModel->find($sale->customer_id);
                $sale->setCustomer($customer);

                // get the motorcycle entity
                $motorcycleModel = new MotorcycleModel();
                $motorcycle = $motorcycleModel->find($sale->motorcycle_id);
                $sale->setMotorcycle($motorcycle);

                // get the admin entity
                $adminModel = new AdminModel();
                $admin = $adminModel->find($sale->admin_id);
                $sale->setAdmin($admin);

                // get spare part sales
                $sparePartSaleModel = new SparePartSaleModel();

                $sparePartSales = $sparePartSaleModel->where('sale_id', $sale->id)->findAll();

                // get spare part sale details
                $sparePartModel = new SparePartModel();

                foreach ($sparePartSales as $sparePartSale) {
                    $sparePart = $sparePartModel->find($sparePartSale->spare_part_id);
                    $sparePartSale->setSparePart($sparePart);
                }

                // set the spare part sales
                $sale->setSparePartSales($sparePartSales);

                // get service sales
                $serviceSaleModel = new ServiceSaleModel();

                $serviceSales = $serviceSaleModel->where('sale_id', $sale->id)->findAll();

                // get service sale details
                $serviceModel = new ServiceModel();

                foreach ($serviceSales as $serviceSale) {
                    $service = $serviceModel->find($serviceSale->service_id);
                    $serviceSale->setService($service);
                }

                // set the service sales
                $sale->setServiceSales($serviceSales);

                // add the sale entity to the array
                $sales[] = $sale;
            }

            return $sales;
        } else {
            return $this->where('id', $id)->first();
        }
    }
    
}
