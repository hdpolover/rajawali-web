<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\PurchaseDetail;


class PurchaseDetailModel extends Model
{
    protected $table = 'purchase_details';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = PurchaseDetail::class;

    protected $allowedFields = [
        'purchase_id',
        'spare_part_id',
        'quantity',
        'buy_price',
        'sell_price',
        'sub_total',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
