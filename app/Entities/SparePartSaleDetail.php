<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class SparePartSaleDetail extends Entity {
    protected $id;
    protected $spare_part_sale_id;
    protected $spare_part_id;
    protected $quantity;
    protected $price;
    protected $sub_total;
    protected $description;
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

        // Manually add missing attributes
        $data['spare_part'] = $this->getSparePart();
        
        return $data;
    }
}