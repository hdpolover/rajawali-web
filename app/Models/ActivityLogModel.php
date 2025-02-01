<?php
// app/Models/SupplierModel.php

namespace App\Models;

use CodeIgniter\Model;

class ActivityLogModel extends Model
{
    protected $table = 'activity_logs';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields = [
        'admin_id',
        'table_name',
        'action_type',
        'description',
        'is_read',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    protected $validationRules = [
        'admin_id' => 'required|integer',
        'table_name' => 'required|string|max_length[100]',
        'action_type' => 'required|in_list[add,edit,delete]',
        'description' => 'required|string',
    ];

    protected $validationMessages = [
        'admin_id' => [
            'required' => "Field ini wajib diisi",
            'integer' => "Field ini harus berupa angka",
        ],
        'table_name' => [
            'required' => "Field ini wajib diisi",
            'string' => "Field ini harus berupa string",
            'max_length' => "Field ini tidak boleh melebihi 100 karakter",
        ],
        'action_type' => [
            'required' => "Field ini wajib diisi",
            'in_list' => "Field ini harus berupa add, edit, atau delete",
        ],
        'description' => [
            'required' => "Field ini wajib diisi",
            'string' => "Field ini harus berupa string",
        ],

    ];

    public function saveActivityLog($data)
    {
        $action = $data['action_type'];

        $action_verb = '';
        $values_str = '';
        // values will be an array of old and new values
        // example: ['old_value' => '0', 'new_value' => '1']

        // use switch case to determine the description based on action type
        switch ($action) {
            case 'add':
                $action_verb = 'menambahkan';

                $values_str .= " " . $data['new_value'];

                break;
            case 'edit':
                $action_verb = 'mengubah';

                $values_str .= " " . $data['old_value'] . " menjadi " . $data['new_value'];

                break;
            case 'delete':
                $action_verb = 'menghapus';

                $values_str .= " " . $data['old_value'];
                break;
            default:
                $action_verb = 'melakukan aksi pada';

                $values_str .= " " . $data['old_value'];
                break;
        }

        $data['description'] = "$action_verb $values_str pada tabel " . $data['table_name'];

        return $this->save($data);
    }

    public function markAsRead($id)
    {
        return $this->update($id, ['is_read' => 1]);
    }

    public function getUnreadActivityLogs()
    {
        return $this->where('is_read', 0)->findAll();
    }
}
