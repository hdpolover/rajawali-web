<?php

namespace App\Models;

use App\Entities\SparePartSaleDetail;
use CodeIgniter\Model;

class SparePartSaleDetailModel extends Model
{
    protected $table = 'spare_part_sale_details';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = SparePartSaleDetail::class;

    protected $allowedFields = [
        'spare_part_sale_id',
        'spare_part_id',
        'quantity',
        'price',
        'sub_total',
        'description',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
}
