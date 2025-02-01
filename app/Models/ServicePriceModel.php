<?php

namespace App\Models;

use CodeIgniter\Model;

class ServicePriceModel extends Model
{
    protected $table = 'service_prices';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields = [
        'service_id',
        'price',
        'effective_date',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'service_id' => 'required|numeric',
        'price' => 'required|numeric',
        'effective_date' => 'required'
    ];

    protected $validationMessages = [
        'service_id' => [
            'required' => 'Layanan harus diisi',
            'numeric' => 'Layanan harus berupa angka'
        ],
        'price' => [
            'required' => 'Harga harus diisi',
            'numeric' => 'Harga harus berupa angka'
        ],
        'effective_date' => [
            'required' => 'Tanggal berlaku harus diisi'
        ]
    ];
}
