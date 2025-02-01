<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class PurchaseDetail extends Entity {
    protected $id;
    protected $purchase_id;
    protected $spare_part_id;
    protected $quantity;
    protected $buy_price;
    protected $sell_price;
    protected $sub_total;
    protected $created_at;
    protected $updated_at;
    protected $deleted_at;

    protected $spare_part;

    // Setter and Getter for Spare Part
    public function setSparePart($sparePart)
    {
        $this->attributes['spare_part'] = $sparePart;
    }

    public function getSparePart()
    {
        return $this->attributes['spare_part'] ?? null;
    }

    // Override toArray to Include Custom Attributes
    public function toArray(bool $onlyChanged = false, bool $cast = true, bool $recursive = false): array
    {
        $data = parent::toArray($onlyChanged, $recursive);

        if ($this->spare_part) {
            $data['spare_part'] = $this->spare_part->toArray();
        }

        return $data;
    }
}