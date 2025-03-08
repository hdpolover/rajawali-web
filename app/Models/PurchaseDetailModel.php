<?php

namespace App\Models;

use CodeIgniter\Model;


class PurchaseDetailModel extends Model
{
    protected $table = 'purchase_details';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';

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
    
    /**
     * Get purchase detail by ID
     *
     * @param int $id
     * @return object|null
     */
    public function getPurchaseDetailById($id)
    {
        return $this->find($id);
    }
    
    /**
     * Update spare part details
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateSparePartDetail($id, array $data)
    {
        return $this->update($id, $data);
    }
}
