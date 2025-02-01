<?php

namespace App\Models;

use App\Entities\ServiceSaleDetail;
use CodeIgniter\Model;

class ServiceSaleDetailModel extends Model
{
    protected $table = 'service_sale_details';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = ServiceSaleDetail::class;

    protected $allowedFields = [
        'service_sale_id',
        'service_id',
        'mechanic_id',
        'quantity',
        'price',
        'sub_total',
        'description',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
}
