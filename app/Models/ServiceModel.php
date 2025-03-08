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
        'price',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'name' => 'required|min_length[3]',
        'description' => 'required',
        'difficulty' => 'required|numeric',
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
            'numeric' => 'Kesulitan harus berupa angka'
        ],

    ];

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
