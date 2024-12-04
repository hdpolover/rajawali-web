<?php
// app/Models/RoleModel.php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\AdminModel;
use App\Models\MenuModel;

class RoleModel extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['name'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'name' => 'required|min_length[3]|is_unique[roles.name,id,{id}]'
    ];

    // Relationships
    public function admins()
    {
        return $this->hasMany(AdminModel::class, 'role_id');
    }

    public function menuItems()
    {
        return $this->belongsToMany(MenuModel::class, 'role_menu_items', 'role_id', 'menu_item_id');
    }

    // Custom Methods
    public function findByName($name)
    {
        return $this->where('name', $name)->first();
    }
}
