<?php
// app/Models/MenuModel.php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'menu_items';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'parent_id',
        'title',
        'icon',
        'url',
        'order_position'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'title' => 'required|min_length[3]',
        'url' => 'required'
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;

    // Relationships
    public function parent()
    {
        return $this->belongsTo(MenuModel::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(MenuModel::class, 'parent_id', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany(RoleModel::class, 'role_menu_items', 'menu_item_id', 'role_id');
    }

    /**
     * Get menu items for a specific role
     */
    public function getMenuByRole($roleId)
    {
        $builder = $this->db->table('menu_items as m')
            ->select('m.*')
            ->join('role_menu_items rm', 'rm.menu_item_id = m.id')
            ->where('rm.role_id', $roleId)
            ->where('m.parent_id IS NULL')
            ->orderBy('m.order_position', 'ASC');

        $parentMenus = $builder->get()->getResult();

        foreach ($parentMenus as $menu) {
            $menu->children = $this->db->table('menu_items as m')
                ->select('m.*')
                ->join('role_menu_items rm', 'rm.menu_item_id = m.id')
                ->where('rm.role_id', $roleId)
                ->where('m.parent_id', $menu->id)
                ->orderBy('m.order_position', 'ASC')
                ->get()
                ->getResult();
        }

        return $parentMenus;
    }

    /**
     * Get all parent menus (no parent_id)
     */
    public function getParentMenus()
    {
        return $this->where('parent_id', null)
            ->orderBy('order_position', 'ASC')
            ->findAll();
    }

    /**
     * Get child menus for a parent
     */
    public function getChildMenus($parentId)
    {
        return $this->where('parent_id', $parentId)
            ->orderBy('order_position', 'ASC')
            ->findAll();
    }

    /**
     * Add menu item
     */
    public function addMenuItem($data)
    {
        return $this->insert($data);
    }

    /**
     * Update menu item
     */
    public function updateMenuItem($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Delete menu item and its children
     */
    public function deleteMenuItem($id)
    {
        // First delete children
        $this->where('parent_id', $id)->delete();
        // Then delete parent
        return $this->delete($id);
    }

    /**
     * Reorder menu items
     */
    public function reorderMenuItems($items)
    {
        foreach ($items as $position => $id) {
            $this->update($id, ['order_position' => $position + 1]);
        }
        return true;
    }
}
