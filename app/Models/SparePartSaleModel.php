<?php

namespace App\Models;


use CodeIgniter\Model;

class SparePartSaleModel extends Model
{
    protected $table = 'spare_part_sales';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $allowedFields = [
        'sale_id',
        'description',
        'total',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
}
