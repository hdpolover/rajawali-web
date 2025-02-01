<?php
// app/Models/SupplierModel.php

namespace App\Models;

use App\Entities\SparePartType;
use CodeIgniter\Model;

class SparePartTypeModel extends Model
{
    protected $table = 'spare_part_types';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = SparePartType::class;
    protected $allowedFields = [
        'name',
        'description',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $validationRules = [
        'name' => 'required|string|max_length[100]',
        'description' => 'required|string',
    ];

    protected $validationMessages = [
        'name' => [
            'required' => "Field ini wajib diisi",
            'string' => "Field ini harus berupa string",
            'max_length' => "Field ini tidak boleh melebihi 100 karakter",
        ],
        'description' => [
            'required' => "Field ini wajib diisi",
            'string' => "Field ini harus berupa string",
        ],
    ];
}
