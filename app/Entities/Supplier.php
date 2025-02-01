<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Supplier extends Entity
{
    protected $id;
    protected $name;
    protected $phone_number;
    protected $address;
    protected $created_at;
    protected $updated_at;
    protected $deleted_at;
}
