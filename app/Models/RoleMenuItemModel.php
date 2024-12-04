<?php
// app/Models/RoleMenuItemModel.php

namespace App\Models;

use CodeIgniter\Model;

class RoleMenuItemModel extends Model
{
    protected $table = 'role_menu_items';
    protected $primaryKey = ['role_id', 'menu_item_id'];
    protected $useAutoIncrement = false;
    protected $returnType = 'object';

    protected $allowedFields = [
        'role_id',
        'menu_item_id'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;

    protected $validationRules = [
        'role_id' => 'required|integer',
        'menu_item_id' => 'required|integer'
    ];

    // Custom Methods
    public function getMenusByRole($roleId)
    {
        return $this->where('role_id', $roleId)
            ->join('menu_items', 'menu_items.id = role_menu_items.menu_item_id')
            ->orderBy('menu_items.order_position', 'ASC')
            ->findAll();
    }

    public function assignMenuToRole($roleId, $menuId)
    {
        return $this->insert([
            'role_id' => $roleId,
            'menu_item_id' => $menuId
        ]);
    }

    public function removeMenuFromRole($roleId, $menuId)
    {
        return $this->where([
            'role_id' => $roleId,
            'menu_item_id' => $menuId
        ])->delete();
    }

    public function syncRoleMenus($roleId, array $menuIds)
    {
        // Delete existing
        $this->where('role_id', $roleId)->delete();

        // Insert new ones
        $data = array_map(function ($menuId) use ($roleId) {
            return [
                'role_id' => $roleId,
                'menu_item_id' => $menuId,
                'created_at' => date('Y-m-d H:i:s')
            ];
        }, $menuIds);

        return $this->insertBatch($data);
    }
}
