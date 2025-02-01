<?php

namespace App\Models;

use App\Entities\ServiceSale;
use CodeIgniter\Model;

class ServiceSaleModel extends Model
{
    protected $table = 'service_sales';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = ServiceSale::class;

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
