<?php
// app/Models/SupplierModel.php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\SparePart;
use App\Entities\SparePartDetail;

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
    protected $returnType = SparePart::class;

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
            // 'photo' => $data['photo'],
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

            // Execute the query and get the result as an array of objects
            $results = $builder->get()->getResultArray();

            $spareParts = [];

            foreach ($results as $row) {
                // Create a new SparePart entity for each spare part
                $sparePart = new SparePart($row);

                // set spare part type
                $sparePartTypeModel = new SparePartTypeModel();

                $sparePartType = $sparePartTypeModel->find($sparePart->spare_part_type_id);

                $sparePart->setType($sparePartType);

                // get spare part detail by spare part id from spare part detail model
                $sparePartDetailModel = new SparePartDetailModel();

                $detail = $sparePartDetailModel->where('spare_part_id', $sparePart->id)->first();

                // Create a SparePartDetail entity and set it
                $details = new SparePartDetail([
                    'id' => $detail->id,
                    'spare_part_id' => $detail->spare_part_id,
                    'current_stock' => $detail->current_stock,
                    'current_sell_price' => $detail->current_sell_price,
                    'current_buy_price' => $detail->current_buy_price,
                    'created_at' => $detail->created_at,
                    'updated_at' => $detail->updated_at,
                    'deleted_at' => $detail->deleted_at,
                ]);

                // Attach the SparePartDetail entity to the SparePart entity
                $sparePart->setDetails($details);

                // Add the entity to the spare parts array
                $spareParts[] = $sparePart;
            }

            return $spareParts; // Return an array of entities

        } else {
            // Perform the query to join spare_parts with spare_part_details
            $builder = $this->db->table('spare_parts');
            $builder->select('spare_parts.*');

            // Execute the query and get the result as an array of objects
            $result = $builder->getWhere(['spare_parts.id' => $id])->getRowArray();

            // Create a new SparePart entity
            $sparePart = new SparePart($result);

            // get spare part detail by spare part id from spare part detail model
            $sparePartDetailModel = new SparePartDetailModel();

            $detail = $sparePartDetailModel->where('spare_part_id', $sparePart->id)->first();

            // Create a SparePartDetail entity and set it
            $details = new SparePartDetail([
                'id' => $detail->id,
                'spare_part_id' => $detail->spare_part_id,
                'current_stock' => $detail->current_stock,
                'current_sell_price' => $detail->current_sell_price,
                'current_buy_price' => $detail->current_buy_price,
                'created_at' => $detail->created_at,
                'updated_at' => $detail->updated_at,
                'deleted_at' => $detail->deleted_at,
            ]);

            // Attach the SparePartDetail entity to the SparePart entity
            $sparePart->setDetails($details);

            return $sparePart; // Return the entity
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
