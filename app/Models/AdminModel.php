<?php
// app/Models/AdminModel.php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admins';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'username',
        'email',
        'password',
        'role_id',
        'active'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'username' => 'required|min_length[3]|is_unique[admins.username,id,{id}]',
        'email'    => 'required|valid_email|is_unique[admins.email,id,{id}]',
        'password' => 'required|min_length[6]',
        'role_id'  => 'required|integer'
    ];

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    // Relationships
    public function role()
    {
        return $this->belongsTo(RoleModel::class, 'role_id');
    }

    // Password hashing callback
    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password'])) {
            return $data;
        }

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }

    // Authentication methods
    public function authenticate($username, $password)
    {
        // Join with roles table to get role name
        $admin = $this->select('admins.*, roles.name as role_name')
            ->join('roles', 'roles.id = admins.role_id')
            ->where('admins.username', $username)
            ->where('admins.active', 1)
            ->first();

        if (!$admin) {
            return false;
        }

        return password_verify($password, $admin->password) ? $admin : false;
    }

    // Profile management
    public function updateProfile($id, $data)
    {
        // Remove password if not changing
        if (empty($data['password'])) {
            unset($data['password']);
        }

        return $this->update($id, $data);
    }

    public function activate($id)
    {
        return $this->update($id, ['active' => 1]);
    }

    public function deactivate($id)
    {
        return $this->update($id, ['active' => 0]);
    }

    public function findByUsername($username)
    {
        return $this->where('username', $username)->first();
    }

    public function findByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}
