<?php
// app/Models/SupplierModel.php

namespace App\Models;

use CodeIgniter\Model;

class SparePartPriceHistoryModel extends Model
{
    protected $table = 'spare_part_price_history';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields = [
        'spare_part_id',
        'old_sell_price',
        'new_sell_price',
        'old_buy_price',
        'new_buy_price',
        'change_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

}
