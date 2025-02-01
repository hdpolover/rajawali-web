<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\PurchasePaymentDetail;


class PurchasePaymentDetailModel extends Model
{
    protected $table = 'purchase_payment_details';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = PurchasePaymentDetail::class;

    protected $allowedFields = [
        'purchase_payment_id',
        'purchase_detail_id',
        'payment_date',
        'payment_type',
        'status',
        'proof',
        'description',
        'sub_total',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'purchase_payment_id' => 'required',
        'purchase_detail_id' => 'required',
        'quantity' => 'required|numeric',
        'buy_price' => 'required|numeric',
        'sub_total' => 'required|numeric',
    ];
}
