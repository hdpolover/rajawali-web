<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\ServicePriceModel;

class ServiceModel extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields = [
        'name',
        'description',
        'difficulty',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'name' => 'required|min_length[3]',
        'description' => 'required',
        'difficulty' => 'required',
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Nama harus diisi',
            'min_length' => 'Nama minimal terdiri dari 3 karakter'
        ],
        'description' => [
            'required' => 'Deskripsi harus diisi'
        ],
        'difficulty' => [
            'required' => 'Kesulitan harus diisi',
        ],
    ];

    /**
     * Save service with price
     * 
     * @param array $serviceData Service data
     * @param float $price Service price
     * @return bool|int Returns service ID if successful, false otherwise
     */
    public function saveWithPrice($serviceData, $price)
    {
        // Make sure we have a database connection
        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            // Insert service data
            $this->save($serviceData);
            
            // Get the ID of the newly inserted service
            $serviceId = $this->insertID();

            // Create ServicePriceModel instance
            $servicePriceModel = new ServicePriceModel();

            // Add entry to service_prices table
            $priceData = [
                'service_id' => $serviceId,
                'price' => $price,
                'effective_date' => date('Y-m-d'), // Current date
            ];
            
            $servicePriceModel->save($priceData);

            // If everything is successful, commit the transaction
            $db->transCommit();
            
            return $serviceId;
        } catch (\Exception $e) {
            // If there are any issues, rollback the transaction
            $db->transRollback();
            
            log_message('error', 'Service save failed: ' . $e->getMessage());
            return false;
        }
    }

    // get service prices
    public function getServices()
    {
        $builder = $this->db->table('services');
        $builder->select('services.*');

        // get services
        $servicesResult = $builder->get()->getResult();

        $services = [];

        // loop through services
        foreach ($servicesResult as $service) {

            // get service prices
            $servicePriceModel = new ServicePriceModel();

            $servicePrices = $servicePriceModel->where('service_id', $service->id)->findAll();

            $service->prices =$servicePrices;

            $services[] = $service;
        }

        return $services;
    }
}
