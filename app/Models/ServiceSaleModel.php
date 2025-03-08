<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceSaleModel extends Model
{
    protected $table = 'service_sales';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $allowedFields = [
        'sale_id',
        'total',
        'description',
        'sale_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
}
