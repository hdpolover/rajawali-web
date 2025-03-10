<?php
// app/Controllers/Dashboard.php

namespace App\Controllers;

use App\Models\SparePartModel;
use App\Models\SparePartTypeModel;
use App\Models\SparePartDetailModel;
use App\Models\SparePartPriceHistoryModel;

class SpareParts extends BaseController
{
    protected $sparePartModel;
    protected $sparePartTypeModel;
    protected $sparePartDetailModel;
    protected $sparePartPriceHistoryModel;

    public function __construct()
    {
        $this->sparePartModel = new SparePartModel();
        $this->sparePartTypeModel = new SparePartTypeModel();
        $this->sparePartDetailModel = new SparePartDetailModel();
        $this->sparePartPriceHistoryModel = new SparePartPriceHistoryModel();
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
            $photo = $this->request->getFile('photo');
            $isBase64 = false;
            $photoFilename = 'default.jpg';

            // Check if a photo was uploaded
            if ($photo && $photo->isValid() && !$photo->hasMoved()) {
                // Upload photo using FileUpload helper with FTP
                $uploadResult = uploadFileToStorage('spare_parts', $photo, $isBase64);

                if (!$uploadResult['status']) {
                    throw new \Exception($uploadResult['message']);
                }

                // Get just the filename from the URL
                $parts = explode('/', $uploadResult['url']);
                $photoFilename = end($parts);
            } else if (!empty($formData['photo']) && strpos($formData['photo'], 'data:image') === 0) {
                // Handle base64 image from camera
                $uploadFile = $formData['photo'];
                $isBase64 = true;
                
                // Upload photo using FileUpload helper with FTP
                $uploadResult = uploadFileToStorage('spare_parts', $uploadFile, $isBase64);
                
                if (!$uploadResult['status']) {
                    throw new \Exception($uploadResult['message']);
                }
                
                // Get just the filename from the URL
                $parts = explode('/', $uploadResult['url']);
                $photoFilename = end($parts);
            }

            // Prepare data for saving
            $data = [
                'name' => $formData['name'],
                'merk' => $formData['brand'],
                'photo' => $photoFilename,
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
    
    public function edit()
    {
        try {
            $formData = $this->request->getPost();
            
            // Get current spare part data
            $id = $formData['id'];
            $sparePart = $this->sparePartModel->find($id);
            
            if (!$sparePart) {
                throw new \Exception('Spare part not found');
            }

            // Get spare part detail
            $sparePartDetail = $this->sparePartDetailModel->where('spare_part_id', $id)->first();
            if (!$sparePartDetail) {
                throw new \Exception('Spare part detail not found');
            }
            
            // Check if a new photo was uploaded
            $photo = $this->request->getFile('photo');
            $photoFilename = $sparePart->photo; // Default to existing photo
            
            if ($photo && $photo->isValid() && !$photo->hasMoved()) {
                // Upload photo using FileUpload helper with FTP
                $uploadResult = uploadFileToStorage('spare_parts', $photo, false);
                
                if (!$uploadResult['status']) {
                    throw new \Exception($uploadResult['message']);
                }
                
                // Get just the filename from the URL
                $parts = explode('/', $uploadResult['url']);
                $photoFilename = end($parts);
            }
            
            // Prepare data for updating spare part
            $sparePartData = [
                'id' => $id,
                'name' => $formData['name'],
                'merk' => $formData['merk'],
                'photo' => $photoFilename,
                'code_number' => $formData['code_number'],
                'description' => $formData['description'],
                'spare_part_type_id' => $formData['type']
            ];
            
            // Update the spare part data
            $this->sparePartModel->save($sparePartData);
            
            // Check if prices have changed
            $priceChanged = ($sparePartDetail->current_sell_price != $formData['sell_price'] || 
                            $sparePartDetail->current_buy_price != $formData['buy_price']);
            
            if ($priceChanged) {
                // Add price history
                $this->sparePartPriceHistoryModel->save([
                    'spare_part_id' => $id,
                    'old_sell_price' => $sparePartDetail->current_sell_price,
                    'new_sell_price' => $formData['sell_price'],
                    'old_buy_price' => $sparePartDetail->current_buy_price,
                    'new_buy_price' => $formData['buy_price'],
                    'change_date' => date('Y-m-d H:i:s'),
                ]);
            }
            
            // Update the spare part detail
            $this->sparePartDetailModel->update($sparePartDetail->id, [
                'current_stock' => $formData['stock'],
                'current_sell_price' => $formData['sell_price'],
                'current_buy_price' => $formData['buy_price']
            ]);
            
            // Add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'spare_parts',
                'action_type' => 'edit',
                'old_value' => $sparePart->name,
                'new_value' => $formData['name'],
            ];
            
            $this->activityLogModel->saveActivityLog($logData);
            
            // Show success message
            session()->setFlashdata('alert', [
                'type' => 'success',
                'message' => 'Spare part berhasil diperbarui.'
            ]);
            
            return redirect()->to('master-data/spare-parts');
        } catch (\Exception $e) {
            log_message('error', 'Failed to edit spare part: ' . $e->getMessage());
            
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Failed to edit spare part: ' . $e->getMessage()
            ]);
            
            return redirect()->back();
        }
    }

    public function delete()
    {
        try {
            $id = $this->request->getPost('delete_id');
            
            // Get current spare part data for activity log
            $sparePart = $this->sparePartModel->find($id);
            
            if (!$sparePart) {
                throw new \Exception('Spare part not found');
            }
            
            // Soft delete the spare part (sets deleted_at)
            $this->sparePartModel->delete($id);
            
            // Add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'spare_parts',
                'action_type' => 'delete',
                'old_value' => $sparePart->name,
                'new_value' => null,
            ];
            
            $this->activityLogModel->saveActivityLog($logData);
            
            // Show success message
            session()->setFlashdata('alert', [
                'type' => 'success',
                'message' => 'Spare part berhasil dihapus.'
            ]);
            
            return redirect()->to('master-data/spare-parts');
        } catch (\Exception $e) {
            log_message('error', 'Failed to delete spare part: ' . $e->getMessage());
            
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Failed to delete spare part: ' . $e->getMessage()
            ]);
            
            return redirect()->back();
        }
    }

    public function generate_barcode() {}
}
