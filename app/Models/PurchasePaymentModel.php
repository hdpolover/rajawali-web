<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Purchasepayment;


class PurchasePaymentModel extends Model
{
    protected $table = 'purchase_payments';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = PurchasePayment::class;

    protected $allowedFields = [
        'purchase_id',
        'status',
        'total',
        'description',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'purchase_id' => 'required',
        'total' => 'required|numeric',
    ];
}
