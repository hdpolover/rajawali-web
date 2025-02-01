<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class SparePart extends Entity
{
    protected $id;
    protected $name;
    protected $merk;
    protected $description;
    protected $photo;
    protected $code_number;
    protected $spare_part_type_id;
    protected $created_at;
    protected $updated_at;
    protected $deleted_at;

    protected $type;
    protected $details;

    // Setter and Getter for Type
    public function setType($type)
    {
        $this->attributes['type'] = $type;
    }

    public function getType()
    {
        return $this->attributes['type'] ?? null;
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

    // Override toArray to Include Custom Attributes
    public function toArray(bool $onlyChanged = false, bool $cast = true, bool $recursive = false): array
    {

        $data = parent::toArray($onlyChanged, $recursive);

        // Manually add missing attributes
        $data['type'] = $this->getType();
        $data['details'] = $this->getDetails();
        
        return $data;
    }
}
