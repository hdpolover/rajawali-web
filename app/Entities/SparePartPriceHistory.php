<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class SparePartPriceHistory extends Entity
{
    protected $id;
    protected $spare_part_id;
    protected $old_sell_price;
    protected $new_sell_price;
    protected $old_buy_price;
    protected $new_buy_price;
    protected $change_date;
    protected $created_at;
    protected $updated_at;
    protected $deleted_at;
}