<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class ServiceSaleDetail extends Entity {
    protected $id;
    protected $service_sale_id;
    protected $mechanic_id;
    protected $service_id;
    protected $quantity;
    protected $price;
    protected $sub_total;
    protected $description;
    protected $created_at;
    protected $updated_at;
    protected $deleted_at;

    protected $mechanic;

    // Setter and Getter for mechanic
    public function setMechanic($mechanic)
    {
        $this->attributes['mechanic'] = $mechanic;
    }

    public function getMechanic()
    {
        return $this->attributes['mechanic'] ?? null;
    }

    // Override toArray to Include Custom Attributes
    public function toArray(bool $onlyChanged = false, bool $cast = true, bool $recursive = false): array
    {

        $data = parent::toArray($onlyChanged, $recursive);

        // Manually add missing attributes
        $data['mechanic'] = $this->getMechanic();
        
        return $data;
    }
}