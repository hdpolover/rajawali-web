<?php

namespace App\Models;

use CodeIgniter\Model;

class MechanicModel extends Model
{
    protected $table = 'mechanics';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';    protected $allowedFields = [
        'name',
        'phone',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $useSoftDeletes = true;    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]',
        'phone' => 'required|numeric|min_length[10]|max_length[15]',
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Nama mekanik harus diisi',
            'min_length' => 'Nama mekanik minimal terdiri dari {param} karakter',
            'max_length' => 'Nama mekanik maksimal terdiri dari {param} karakter'
        ],
        'phone' => [
            'required' => 'Nomor telepon harus diisi',
            'numeric' => 'Nomor telepon harus berupa angka',
            'min_length' => 'Nomor telepon minimal terdiri dari {param} karakter',        'max_length' => 'Nomor telepon maksimal terdiri dari {param} karakter'
        ],
        
    ];
}
