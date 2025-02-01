<?php
// app/Models/SupplierModel.php

namespace App\Models;
use CodeIgniter\Model;

// import entities
use App\Entities\Supplier;


class SupplierModel extends Model
{
    protected $table = 'suppliers';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = Supplier::class;

    protected $allowedFields = [
        'name',
        'phone_number',
        'address'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'name'    => 'required',
        'phone_number'   => 'required',
        'address' => 'required'
    ];

    protected $validationMessages = [
        'name'        => [
            'required' => 'Nama supplier wajib diisi.'
        ],
        'phone_number'       => [
            'required' => 'Nomor telepon wajib diisi.'
        ],
        'address' => [
            'required' => 'Alamat wajib diisi.'
        ]
    ];

    protected $skipValidation = false;

    public function getSupplier($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }

        return $this->find($id);
    }
}
?>