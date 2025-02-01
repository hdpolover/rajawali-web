<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Admin extends Entity
{
    protected $id;
    protected $username;
    protected $email;
    protected $password;
    protected $role_id;
    protected $active;
    protected $created_at;
    protected $updated_at;
    protected $deleted_at;

}
