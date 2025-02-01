<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class PurchasePayment extends Entity {
    protected $id;
    protected $purchase_id;
    protected $status;
    protected $total;
    protected $description;
    protected $created_at;
    protected $updated_at;
    protected $deleted_at;

    protected $details;

    // Setter and Getter for Details
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

        if ($this->details) {
            $data['details'] = $this->details->toArray();
        }

        return $data;
    }
}