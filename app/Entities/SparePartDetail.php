<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class SparePartDetail extends Entity {
    protected $id;
    protected $spare_part_id;
    protected $current_stock;
    protected $current_sell_price;
    protected $current_buy_price;
    protected $created_at;
    protected $updated_at;
    protected $deleted_at;

    // Any additional properties or methods specific to the object can go here.
    // Optionally add getters and setters for additional functionality.
}