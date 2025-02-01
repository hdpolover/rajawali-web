<?php

namespace App\Models;

use App\Entities\SparePartSale;
use CodeIgniter\Model;

class SparePartSaleModel extends Model
{
    protected $table = 'spare_part_sales';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = SparePartSale::class;

    protected $allowedFields = [
        'sale_id',
        'description',
        'total',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
}
