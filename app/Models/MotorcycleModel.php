<?php

namespace App\Models;

use CodeIgniter\Model;

class MotorcycleModel extends Model
{
    protected $table = 'motorcycles';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields = [
        'model',
        'brand',
        'customer_id',
        'license_number',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'model' => 'required',
        'brand' => 'required',
        'customer_id' => 'required',
        'license_number' => 'required'
    ];

    protected $validationMessages = [
        'model' => [
            'required' => 'Model harus diisi'
        ],
        'brand' => [
            'required' => 'Merek harus diisi'
        ],
        'customer_id' => [
            'required' => 'Pemilik harus diisi'
        ],
        'license_number' => [
            'required' => 'Nomor plat harus diisi'
        ]
    ];
}
