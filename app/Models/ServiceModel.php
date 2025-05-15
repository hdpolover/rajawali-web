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
        'updated_at',
        'deleted_at'  // Add this for soft deletes
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';  // Add this for soft deletes
    protected $useSoftDeletes = true;  // Enable soft deletes

    // Overriding the delete method to add more logging
    public function delete($id = null, bool $purge = false)
    {
        log_message('debug', 'ServiceModel::delete called with ID: ' . $id . ', purge: ' . ($purge ? 'true' : 'false'));
        
        // Get the current record before deletion for logging purposes
        $record = $this->find($id);
        log_message('debug', 'Record before deletion: ' . json_encode($record));
        
        // Call parent delete method which will do soft delete
        $result = parent::delete($id, $purge);
        
        // Check result
        log_message('debug', 'Delete result: ' . ($result ? 'success' : 'failed'));
        
        // Check if soft delete worked by finding the record with withDeleted()
        $deletedRecord = $this->withDeleted()->find($id);
        log_message('debug', 'Record after soft delete: ' . json_encode($deletedRecord));
        
        return $result;
    }

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
    }    // get service prices
    public function getServices()
    {
        $builder = $this->db->table('services');
        $builder->select('services.*');
        
        // Add where clause to exclude deleted records
        $builder->where('services.deleted_at IS NULL');
        
        // Log the generated SQL for debugging
        log_message('debug', 'getServices SQL: ' . $this->db->getLastQuery());

        // get services
        $servicesResult = $builder->get()->getResult();
        
        // Log how many records were found
        log_message('debug', 'getServices found ' . count($servicesResult) . ' services');

        $services = [];

        // loop through services
        foreach ($servicesResult as $service) {

            // get service prices
            $servicePriceModel = new ServicePriceModel();

            $servicePrices = $servicePriceModel->where('service_id', $service->id)->findAll();

            $service->prices = $servicePrices;

            $services[] = $service;
        }

        return $services;
    }
}
