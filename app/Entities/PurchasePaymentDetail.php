<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class PurchasePaymentDetail extends Entity {
    protected $id;
    protected $purchase_payment_id;
    protected $payment_date;
    protected $proof;
    protected $payment_type;
    protected $status;
    protected $sub_total;
    protected $description;
    protected $created_at;
    protected $updated_at;
    protected $deleted_at;
}