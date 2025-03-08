<?php
// app/Models/SupplierModel.php

namespace App\Models;

use CodeIgniter\Model;

class SparePartDetailModel extends Model
{
    protected $table = 'spare_part_details';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields = [
        'spare_part_id',
        'current_stock',
        'current_sell_price',
        'current_buy_price',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $validationRules = [
        'spare_part_id' => 'required|is_not_unique[spare_parts.id]',
        'current_stock' => 'required|integer',
        'current_sell_price' => 'required|decimal',
        'current_buy_price' => 'required|decimal',
    ];

    protected $validationMessages = [
        'spare_part_id' => [
            'required' => 'Field ini wajib diisi',
            'is_not_unique' => 'Spare part tidak ditemukan',
        ],
        'current_stock' => [
            'required' => 'Field ini wajib diisi',
            'integer' => 'Field ini harus berupa angka',
        ],
        'current_sell_price' => [
            'required' => 'Field ini wajib diisi',
            'decimal' => 'Field ini harus berupa angka desimal',
        ],
        'current_buy_price' => [
            'required' => 'Field ini wajib diisi',
            'decimal' => 'Field ini harus berupa angka desimal',
        ],
    ];

    // update stock
    public function updateStock($sparePartid, $stock)
    {
        // find spare part detail by spare part id
        $sparePartDetail = $this->where('spare_part_id', $sparePartid)->first();

        // spare part detail id
        $id = $sparePartDetail->id;

        // get current stock
        $currentStock = $sparePartDetail->current_stock;

        // subtract stock
        $newStock = $currentStock - $stock;

        // update stock
        $this->update($id, ['current_stock' => $newStock]);
    }
}
