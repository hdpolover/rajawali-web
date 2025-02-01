<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class SalePaymentDetail extends Entity {
    protected $id;
    protected $sale_payment_id;
    protected $payment_method;
    protected $payment_date;
    protected $amount;
    protected $description;
    protected $status;
    protected $proof;
    protected $created_at;
    protected $updated_at;
    protected $deleted_at;

}