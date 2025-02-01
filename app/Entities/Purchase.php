<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Purchase extends Entity {
    protected $id;
    protected $supplier_id;
    protected $description;
    protected $total;
    protected $admin_id;
    protected $status;
    protected $purchase_date;
    protected $created_at;
    protected $updated_at;
    protected $deleted_at;

    protected $supplier;
    protected $admin;
    protected $details;
    protected $payment;

    // Setter and Getter for Admin
    public function setAdmin($admin)
    {
        $this->attributes['admin'] = $admin;
    }

    public function getAdmin()
    {
        return $this->attributes['admin'] ?? null;
    }

    // Setter and Getter for Supplier
    public function setSupplier($supplier)
    {
        $this->attributes['supplier'] = $supplier;
    }

    public function getSupplier()
    {
        return $this->attributes['supplier'] ?? null;
    }

    // Setter and Getter for Details
    public function setDetails($details)
    {
        $this->attributes['details'] = $details;
    }

    public function getDetails()
    {
        return $this->attributes['details'] ?? null;
    }

    // Setter and Getter for Payment
    public function setPayment($payment)
    {
        $this->attributes['payment'] = $payment;
    }

    public function getPayment()
    {
        return $this->attributes['payment'] ?? null;
    }

    // Override toArray to Include Custom Attributes
    public function toArray(bool $onlyChanged = false, bool $cast = true, bool $recursive = false): array
    {
        $data = parent::toArray($onlyChanged, $recursive);

        // Manually add missing attributes
        $data['supplier'] = $this->getSupplier();
        $data['admin'] = $this->getAdmin();
        $data['details'] = $this->getDetails();
        $data['payment'] = $this->getPayment();

        return $data;
    }
}