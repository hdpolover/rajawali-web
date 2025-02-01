<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields = [
        'name',
        'phone',
        'address',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'name' => 'required|min_length[3]',
        'phone' => 'required|numeric|min_length[10]',
        'address' => 'permit_empty'
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Nama harus diisi',
            'min_length' => 'Nama minimal terdiri dari 3 karakter'
        ],
        'phone' => [
            'required' => 'Nomor telepon harus diisi',
            'numeric' => 'Nomor telepon harus berupa angka',
            'min_length' => 'Nomor telepon minimal terdiri dari 10 karakter'
        ],
        
    ];
}
