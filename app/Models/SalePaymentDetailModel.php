<?php

namespace App\Models;

use CodeIgniter\Model;

class SalePaymentDetailModel extends Model
{
    protected $table = 'sale_payment_details';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $allowedFields = [
        'sale_payment_id',
        'payment_method',
        'amount',
        'proof',
        'status',
        'payment_date', 
        'description',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
}
