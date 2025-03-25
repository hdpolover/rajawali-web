<?php
// app/Models/SupplierModel.php

namespace App\Models;

use CodeIgniter\Model;

class SparePartModel extends Model
{
    protected $table = 'spare_parts';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'spare_part_type_id',
        'name',
        'merk',
        'photo',
        'code_number',
        'description',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $returnType = 'object';

    protected $validationRules = [
        'name' => 'required|string|max_length[100]',
        'merk' => 'string|max_length[100]',
        'description' => 'required|string',
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Field ini wajib diisi',
            'string' => 'Field ini harus berupa string',
            'max_length' => 'Field ini tidak boleh melebihi 100 karakter',
        ],
        'merk' => [
            'string' => 'Field ini harus berupa string',
            'max_length' => 'Field ini tidak boleh melebihi 100 karakter',
        ],
        'description' => [
            'required' => 'Field ini wajib diisi',
            'string' => 'Field ini harus berupa string',
        ],
    ];

    // add spare part with the price details
    public function saveWithPriceDetails($data)
    {

        $spData = [
            'name' => $data['name'],
            'merk' => $data['merk'],
            'photo' => $data['photo'],
            'code_number' => $data['code_number'],
            'description' => $data['description'],
            'spare_part_type_id' => $data['spare_part_type_id'],
        ];

        // save the spare part
        $this->save($spData);

        // get the last inserted id
        $sparePartId = $this->insertID();

        // add price details
        $sparePartDetailModel = new SparePartDetailModel();

        $sparePartDetailModel->save([
            'spare_part_id' => $sparePartId,
            'current_stock' => $data['current_stock'],
            'current_sell_price' => $data['current_sell_price'],
            'current_buy_price' => $data['current_buy_price'],
        ]);

        // add price history
        $sparePartPriceHistoryModel = new SparePartPriceHistoryModel();

        $sparePartPriceHistoryModel->save([
            'spare_part_id' => $sparePartId,
            'old_buy_price' => 0,
            'old_sell_price' => 0,
            'new_buy_price' => $data['current_buy_price'],
            'new_sell_price' => $data['current_sell_price'],
            'change_date' => date('Y-m-d H:i:s'),
        ]);

        // return the new spare part with the price details
        return $this->getWithPriceDetails($sparePartId);
    }

    // get spare part with the price details
    public function getWithPriceDetails($id = null)
    {
        if ($id == null) {
            // Perform the query to join spare_parts with spare_part_details
            $builder = $this->db->table('spare_parts');
            $builder->select('spare_parts.*');
            // if deleted_at is not null, then get the spare parts that are not deleted
            $builder->where('spare_parts.deleted_at', null);

            // Execute the query and get the result as an array of objects
            $results = $builder->get()->getResult();

            $spareParts = [];

            foreach ($results as $sparePart) {
                // set spare part type
                $sparePartTypeModel = new SparePartTypeModel();
                $sparePartType = $sparePartTypeModel->find($sparePart->spare_part_type_id);
                $sparePart->type = $sparePartType;

                // get spare part detail by spare part id from spare part detail model
                $sparePartDetailModel = new SparePartDetailModel();
                $detail = $sparePartDetailModel->where('spare_part_id', $sparePart->id)->first();

                // Create a details object and attach it to the spare part
                $sparePart->details = $detail;

                // Add the object to the spare parts array
                $spareParts[] = $sparePart;
            }

            return $spareParts; // Return an array of objects

        } else {
            // Perform the query to join spare_parts with spare_part_details
            $builder = $this->db->table('spare_parts');
            $builder->select('spare_parts.*');

            // Execute the query and get the result as an object
            $sparePart = $builder->getWhere(['spare_parts.id' => $id])->getRow();

            if (!$sparePart) {
                return null;
            }

            // set spare part type
            $sparePartTypeModel = new SparePartTypeModel();
            $sparePartType = $sparePartTypeModel->find($sparePart->spare_part_type_id);
            $sparePart->type = $sparePartType;

            // get spare part detail by spare part id from spare part detail model
            $sparePartDetailModel = new SparePartDetailModel();
            $detail = $sparePartDetailModel->where('spare_part_id', $sparePart->id)->first();
            $sparePart->details = $detail;

            return $sparePart; // Return the object
        }
    }

    // get price history by spare part id
    public function getPriceHistory($id)
    {
        $builder = $this->db->table('spare_part_price_history');
        $builder->select('old_sell_price, new_sell_price, old_buy_price, new_buy_price, change_date');
        $builder->where('spare_part_id', $id);
        $builder->orderBy('change_date', 'desc');

        return $builder->get()->getResultArray();
    }
}
