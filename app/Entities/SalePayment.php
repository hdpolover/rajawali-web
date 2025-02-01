<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class SalePayment extends Entity {
    protected $id;
    protected $sale_id;
    protected $total;
    protected $description;
    protected $status;
    protected $created_at;
    protected $updated_at;
    protected $deleted_at;

    protected $details;

    // Setter and Getter for Service Sale Details
    public function setDetails($details)
    {
        $this->attributes['details'] = $details;
    }

    public function getDetails()
    {
        return $this->attributes['details'] ?? null;
    }

    // Override toArray to Include Custom Attributes
    public function toArray(bool $onlyChanged = false, bool $cast = true, bool $recursive = false): array
    {

        $data = parent::toArray($onlyChanged, $recursive);

        // Manually add missing attributes
        $data['details'] = $this->getDetails();
        
        return $data;
    }
}