<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Sale extends Entity {
    protected $id;
    protected $sale_number;
    protected $customer_id;
    protected $motorcycle_id;
    protected $description;
    protected $discount;
    protected $total;
    protected $admin_id;
    protected $status;
    protected $sale_date;
    protected $created_at;
    protected $updated_at;
    protected $deleted_at;

    protected $customer;
    protected $motorcycle;
    protected $admin;
    protected $spare_part_sales;
    protected $service_sales;
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

    // Setter and Getter for Customer
    public function setCustomer($customer)
    {
        $this->attributes['customer'] = $customer;
    }

    public function getCustomer()
    {
        return $this->attributes['customer'] ?? null;
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

    // Setter and Getter for Motorcycle
    public function setMotorcycle($motorcycle)
    {
        $this->attributes['motorcycle'] = $motorcycle;
    }

    public function getMotorcycle()
    {
        return $this->attributes['motorcycle'] ?? null;
    }

    // Setter and Getter for Spare Parts Sales
    public function setSparePartSales($sparePartSales)
    {
        $this->attributes['spare_part_sales'] = $sparePartSales;
    }

    public function getSparePartSales()
    {
        return $this->attributes['spare_part_sales'] ?? null;
    }

    // Setter and Getter for Service Sales
    public function setServiceSales($serviceSales)
    {
        $this->attributes['service_sales'] = $serviceSales;
    }

    public function getServiceSales()
    {
        return $this->attributes['service_sales'] ?? null;
    }



    // Override toArray to Include Custom Attributes
    public function toArray(bool $onlyChanged = false, bool $cast = true, bool $recursive = false): array
    {

        $data = parent::toArray($onlyChanged, $recursive);

        // Manually add missing attributes
        $data['customer'] = $this->getCustomer();
        $data['admin'] = $this->getAdmin();
        $data['motorcycle'] = $this->getMotorcycle();
        $data['spare_part_sales'] = $this->getSparePartSales();
        $data['service_sales'] = $this->getServiceSales();
        $data['payment'] = $this->getPayment();
        
        return $data;
    }
}