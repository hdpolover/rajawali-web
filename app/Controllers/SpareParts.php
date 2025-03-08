<?php
// app/Controllers/Dashboard.php

namespace App\Controllers;

use App\Models\SparePartModel;
use App\Models\SparePartTypeModel;

class SpareParts extends BaseController
{
    protected $sparePartModel;
    protected $sparePartTypeModel;

    public function __construct()
    {
        $this->sparePartModel = new SparePartModel();
        $this->sparePartTypeModel = new SparePartTypeModel();
    }

    public function index()
    {
        $data = [
            'title'       => 'Data Spare Part',
            'spare_parts' => $this->sparePartModel->getWithPriceDetails(),
            'spare_part_types' => $this->sparePartTypeModel->findAll(),
        ];

        // sort spare parts by stock ascending
        usort($data['spare_parts'], function ($a, $b) {
            return $a->details->current_stock - $b->details->current_stock;
        });


        return $this->render('pages/spare_part/index', $data);
    }

    // add new
    public function new()
    {
        $data = [
            'title' => 'Tambah Spare Part Baru',
            'spare_part_types' => $this->sparePartTypeModel->findAll(),
        ];

        return $this->render('pages/spare_part/new', $data);
    }

    // fetch spare parts data
    public function fetch()
    {
        $response = array();

        if ($this->request->getPost('name')) {

            $searchTerm = $this->request->getPost('name');

            $spareParts = $this->sparePartModel->select('id,merk,name,code_number')
                ->groupStart()
                ->like('name', $searchTerm)
                ->orLike('code_number', $searchTerm)
                ->groupEnd()
                ->orderBy('name')
                ->findAll();
        } else {
            $spareParts = $this->sparePartModel->findAll();
        }

        // return data as data with id and name
        $data = [];

        foreach ($spareParts as $sparePart) {
            $data[] = [
                // convert id to int
                'id' => (int)$sparePart->id,
                'code_number' => $sparePart->code_number,
                'text' => $sparePart->merk . " " . $sparePart->name,
            ];
        }

        $response['data'] = $data;

        return $this->response->setJSON($response);
    }

    // get price history by spare part id and return as json
    public function price_history($sparePartId)
    {
        $priceHistories = $this->sparePartModel->getPriceHistory($sparePartId);

        return $this->response->setJSON($priceHistories);
    }

    public function add()
    {
        try {
            $formData = $this->request->getPost();
            // $photo = $this->request->getFile('photo');
            $isBase64 = false;

            // Check if it's a regular file upload or base64 image
            // if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            //     $uploadFile = $photo;
            // } else if (!empty($formData['photo']) && strpos($formData['photo'], 'data:image') === 0) {
            //     $uploadFile = $formData['photo'];
            //     $isBase64 = true;
            // } else {
            //     throw new \Exception('No valid photo provided');
            // }

            // // Upload photo using FileUpload helper
            // $uploadResult = uploadFileToStorage('spare_parts', $uploadFile, $isBase64);

            // if (!$uploadResult['status']) {
            //     throw new \Exception($uploadResult['message']);
            // }

            // // Set photo URL to form data
            // $formData['photo'] = $uploadResult['url'];

            // Prepare data for saving
            $data = [
                'name' => $formData['name'],
                'merk' => $formData['brand'],
                'photo' => 'default.jpg',
                'code_number' => $formData['sparePartCode'],
                'description' => $formData['description'],
                'spare_part_type_id' => $formData['type'],
                'current_stock' => $formData['initialStock'],
                'current_sell_price' => $formData['initialSellingPrice'],
                'current_buy_price' => $formData['initialPurchasePrice'],
            ];

            // Save spare part with price details
            $result = $this->sparePartModel->saveWithPriceDetails($data);

            if (!$result) {
                throw new \Exception('Failed to save spare part data');
            }

            // Add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'spare_parts',
                'action_type' => 'add',
                'old_value' => null,
                'new_value' => $formData['name'],
            ];

            $this->activityLogModel->saveActivityLog($logData);

            // Show success message
            session()->setFlashdata('alert', [
                'type' => 'success',
                'message' => 'Spare part berhasil ditambahkan.'
            ]);

            return redirect()->to('master-data/spare-parts');
        } catch (\Exception $e) {
            log_message('error', 'Failed to add spare part: ' . $e->getMessage());

            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Failed to add spare part: ' . $e->getMessage()
            ]);

            return redirect()->back()->withInput();
        }
    }

    public function generate_barcode() {}
}
