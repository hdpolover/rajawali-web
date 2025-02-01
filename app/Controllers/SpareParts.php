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

        return $this->render('pages/spare_part/index', $data);
    }

    // fetch spare parts data
    public function fetch()
    {
        $response = array();

        if ($this->request->getPost('name')) {

            $searchTerm = $this->request->getPost('name');

            $spareParts = $this->sparePartModel->select('id,name,code_number')
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
                'text' => $sparePart->name,
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

    public function add() {
        // get form data from multipart form
        $formData = [
            'name' => $this->request->getPost('name'),
            'merk' => $this->request->getPost('merk'),
            // 'photo' => $this->request->getFile('photo'),
            'code_number' => $this->request->getPost('code_number'),
            'description' => $this->request->getPost('description'),
            'spare_part_type_id' => $this->request->getPost('type'),
            'current_stock' => $this->request->getPost('stock'),
            'current_sell_price' => $this->request->getPost('sell_price'),
            'current_buy_price' => $this->request->getPost('buy_price'),
        ];

        // validate form data
        // if (!$this->validate([
        //     'name' => 'required|string|max_length[100]',
        //     'merk' => 'string|max_length[100]',
        //     'description' => 'required|string',
        //     'photo' => 'uploaded[photo]|max_size[photo,1024]|is_image[photo]',
        //     'stock' => 'required|numeric',
        //     'sell_price' => 'required|numeric',
        //     'buy_price' => 'required|numeric',
        // ])) {
        //     return redirect()->to('/spare-parts')->withInput()->with('errors', $this->validator->getErrors());
        // }

        //upload photo and use FileUpload helper
        // $photo = $formData['photo'];

        // // check if photo is not empty
        // if ($photo->getSize() == 0) {
        //     log_message('error', 'Photo is empty');

        //     return;
        // } 
        // // use FileUpload helper
        // $photoPath = uploadFileToStorage('spare_parts', $photo);

        // // set photo path to form data
        // $formData['photo'] = $photoPath;

        // save spare part with price details
        $result = $this->sparePartModel->saveWithPriceDetails($formData);

        if ($result) {
            // add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'spare_parts',
                'action_type' => 'add',
                'old_value' => null,
                'new_value' => $formData['name'],
            ];

            $this->activityLogModel->saveActivityLog($logData);

            // show success message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'success',
                'message' => 'Spare part berhasil ditambahkan.'
            ]);

            return redirect()->to('/spare-parts');
        } else {
            // show error message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Spare part gagal ditambahkan.'
            ]);

            return redirect()->to('/spare-parts');
        }
    }

    public function generate_barcode() {
        
    }
}