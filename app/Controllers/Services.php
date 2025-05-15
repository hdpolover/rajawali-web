<?php
// app/Controllers/Dashboard.php

namespace App\Controllers;

use App\Models\ServiceModel;
use App\Models\ServicePriceModel;
use App\Models\ActivityLogModel;

class Services extends BaseController
{
    protected $serviceModel;
    protected $servicePriceModel;

    public function __construct()
    {
        $this->serviceModel = new ServiceModel();
        $this->servicePriceModel = new ServicePriceModel();
        // Make sure the activity log model is initialized
        $this->activityLogModel = new ActivityLogModel();
    }

    public function index()
    {
        $data = [
            'title'       => 'Data Servis',
            'services' => $this->serviceModel->getServices(),
        ];

        return $this->render('pages/service/index', $data);
    }

    // add function
    public function add()
    {
        // Add detailed logging for debugging
        log_message('debug', 'Services add method called');
        log_message('debug', 'POST data: ' . json_encode($this->request->getPost()));

        // get form data for service table
        $formData = [
            'name' => $this->request->getPost('service_name'),
            'description' => $this->request->getPost('description'),
            'difficulty' => $this->request->getPost('difficulty')
        ];

        // Get the price for service_prices table
        $price = $this->request->getPost('price');

        // Set custom validation rules for the form fields
        $validation = \Config\Services::validation();
        $validation->setRules([
            'service_name' => [
                'label' => 'Nama Layanan',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Nama layanan harus diisi',
                    'min_length' => 'Nama layanan minimal terdiri dari 3 karakter'
                ]
            ],
            'description' => [
                'label' => 'Deskripsi',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi harus diisi'
                ]
            ],
            'difficulty' => [
                'label' => 'Tingkat Kesulitan',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tingkat kesulitan harus diisi'
                ]
            ],
            'price' => [
                'label' => 'Harga',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga harus diisi',
                    'numeric' => 'Harga harus berupa angka'
                ]
            ]
        ]);

        // Run the validation
        if (!$validation->withRequest($this->request)->run()) {
            // For AJAX requests, return JSON with validation errors
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validation->getErrors()
                ]);
            }
            
            log_message('debug', 'Validation errors: ' . json_encode($validation->getErrors()));
            return redirect()->to('/master-data/services')->withInput()->with('errors', $validation->getErrors());
        }

        // Use the model method to save both service and price
        $result = $this->serviceModel->saveWithPrice($formData, $price);

        if ($result) {
            log_message('debug', 'Service saved successfully with ID: ' . $result);
            // add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'services',
                'action_type' => 'add',
                'old_value' => null,
                'new_value' => $formData['name'],
            ];

            $this->activityLogModel->saveActivityLog($logData);

            // For AJAX requests, return JSON response
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status' => true,
                    'message' => 'Data servis berhasil ditambahkan.'
                ]);
            }

            // show success message and redirect for non-AJAX requests
            session()->setFlashdata('alert', [
                'type' => 'success',
                'message' => 'Data servis berhasil ditambahkan.'
            ]);

            return redirect()->to('/master-data/services');
        } else {
            log_message('error', 'Failed to save service with price');
            
            // For AJAX requests, return JSON response
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Gagal menambahkan data servis.'
                ]);
            }
            
            // show error message and redirect for non-AJAX requests
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Gagal menambahkan data servis.'
            ]);

            return redirect()->to('/master-data/services');
        }
    }

    // fetch
    public function fetch()
    {
        $response = array();

        $searchTerm = $this->request->getPost('name');

        if ($searchTerm) {
            $services = $this->serviceModel->select('id,name')
                ->like('name', $searchTerm)
                ->orderBy('name')
                ->findAll();
        } else {
            $services = $this->serviceModel->findAll();
        }

        // return data as data with id and name
        $data = [];

        foreach ($services as $service) {
            $data[] = [
                // convert id to int
                'id' => (int)$service->id,
                'text' => $service->name,
            ];
        }

        $response['data'] = $data;

        return $this->response->setJSON($response);
    }

    // edit function
    public function edit()
    {
        // Log for debugging
        log_message('debug', 'Services edit method called');
        log_message('debug', 'POST data: ' . json_encode($this->request->getPost()));

        // Get form data for service table
        $serviceId = $this->request->getPost('service_id');
        $formData = [
            'id' => $serviceId,
            'name' => $this->request->getPost('service_name'),
            'description' => $this->request->getPost('description'),
            'difficulty' => $this->request->getPost('difficulty')
        ];

        // Get the new price for service_prices table
        $price = $this->request->getPost('price');

        // Set custom validation rules for the form fields
        $validation = \Config\Services::validation();
        $validation->setRules([
            'service_id' => [
                'label' => 'ID Layanan',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'ID layanan harus diisi',
                    'numeric' => 'ID layanan harus berupa angka'
                ]
            ],
            'service_name' => [
                'label' => 'Nama Layanan',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Nama layanan harus diisi',
                    'min_length' => 'Nama layanan minimal terdiri dari 3 karakter'
                ]
            ],
            'description' => [
                'label' => 'Deskripsi',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi harus diisi'
                ]
            ],
            'difficulty' => [
                'label' => 'Tingkat Kesulitan',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tingkat kesulitan harus diisi'
                ]
            ],
            'price' => [
                'label' => 'Harga',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga harus diisi',
                    'numeric' => 'Harga harus berupa angka'
                ]
            ]
        ]);

        // Run the validation
        if (!$validation->withRequest($this->request)->run()) {
            // For AJAX requests, return JSON with validation errors
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validation->getErrors()
                ]);
            }
            
            log_message('debug', 'Validation errors: ' . json_encode($validation->getErrors()));
            return redirect()->to('/master-data/services')->withInput()->with('errors', $validation->getErrors());
        }

        // Get old service data for activity log
        $oldService = $this->serviceModel->find($serviceId);

        // Update service data
        $result = $this->serviceModel->save($formData);

        // Check if we need to add a new price
        $latestPrice = $this->servicePriceModel->where('service_id', $serviceId)
            ->orderBy('effective_date', 'DESC')
            ->first();

        // Only add a new price entry if the price has changed
        if (!$latestPrice || $latestPrice->price != $price) {
            // Add new entry to service_prices table
            $priceData = [
                'service_id' => $serviceId,
                'price' => $price,
                'effective_date' => date('Y-m-d'), // Current date
            ];
            
            $this->servicePriceModel->save($priceData);
        }

        if ($result) {
            // Add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'services',
                'action_type' => 'edit',
                'old_value' => $oldService->name,
                'new_value' => $formData['name'],
            ];

            $this->activityLogModel->saveActivityLog($logData);

            // For AJAX requests, return JSON response
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status' => true,
                    'message' => 'Data servis berhasil diperbarui.'
                ]);
            }

            // Show success message and redirect for non-AJAX requests
            session()->setFlashdata('alert', [
                'type' => 'success',
                'message' => 'Data servis berhasil diperbarui.'
            ]);
        } else {
            // For AJAX requests, return JSON response
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Gagal memperbarui data servis.'
                ]);
            }
            
            // Show error message for non-AJAX requests
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Gagal memperbarui data servis.'
            ]);
        }

        return redirect()->to('/master-data/services');
    }    
    
    // delete function
    public function delete()
    {
        // Get service ID from POST data
        $serviceId = $this->request->getPost('service_id');
        
        // Add debug logging
        log_message('debug', 'Delete service called, ID: ' . $serviceId);
        
        // Get old service data for activity log
        $oldService = $this->serviceModel->find($serviceId);

        if (!$oldService) {
            log_message('error', 'Service not found for deletion, ID: ' . $serviceId);
            
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Servis tidak ditemukan.'
                ]);
            }
            
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Servis tidak ditemukan.'
            ]);
            
            return redirect()->to('/master-data/services');
        }
        
        // Log before delete operation
        log_message('debug', 'About to delete service: ' . json_encode($oldService));
        
        // Perform the delete - this should be a soft delete since the model has $useSoftDeletes = true
        $deleteResult = $this->serviceModel->delete($serviceId);
        
        // Log the delete result
        log_message('debug', 'Delete result: ' . ($deleteResult ? 'success' : 'failed'));
        
        // Check if the record was soft deleted by looking for it with withDeleted()
        $deletedService = $this->serviceModel->withDeleted()->find($serviceId);
        log_message('debug', 'Service after delete: ' . json_encode($deletedService));

        if ($oldService && $deleteResult) {
            // Add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'services',
                'action_type' => 'delete',
                'old_value' => $oldService->name,
                'new_value' => null,
            ];

            $this->activityLogModel->saveActivityLog($logData);

            // For AJAX requests, return JSON response
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status' => true,
                    'message' => 'Data servis berhasil dihapus.'
                ]);
            }

            // Show success message for non-AJAX requests
            session()->setFlashdata('alert', [
                'type' => 'success',
                'message' => 'Data servis berhasil dihapus.'
            ]);
        } else {
            // For AJAX requests, return JSON response
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Gagal menghapus data servis.'
                ]);
            }
            
            // Show error message for non-AJAX requests
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Gagal menghapus data servis.'
            ]);
        }

        return redirect()->to('/master-data/services');
    }
      // Get archived services
    public function archived()
    {
        log_message('debug', 'Services::archived method called');
        
        // Use a query builder to force check for non-null deleted_at
        $services = $this->serviceModel->builder()
            ->select('services.*')
            ->where('services.deleted_at IS NOT NULL')
            ->get()
            ->getResult();
            
        log_message('debug', 'Found ' . count($services) . ' archived services');
        log_message('debug', 'SQL: ' . $this->serviceModel->db->getLastQuery());
        
        // Get prices for each service
        foreach ($services as &$service) {
            $service->prices = $this->servicePriceModel->where('service_id', $service->id)->findAll();
        }
        
        $data = [
            'title'       => 'Servis Diarsipkan',
            'services' => $services,
        ];

        return $this->response->setJSON($services);
    }
    
    // Restore a service from archive
    public function restore($id)
    {
        // Get deleted service
        $service = $this->serviceModel->onlyDeleted()->find($id);
        
        if (!$service) {
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Servis tidak ditemukan.'
            ]);
            return redirect()->to('/master-data/services');
        }
        
        // Update the deleted_at field to null to restore
        if ($this->serviceModel->update($id, ['deleted_at' => null])) {
            // Add activity log
            $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'services',
                'action_type' => 'restore',
                'old_value' => null,
                'new_value' => $service->name,
            ];

            $this->activityLogModel->saveActivityLog($logData);
            
            session()->setFlashdata('alert', [
                'type' => 'success',
                'message' => 'Servis berhasil dipulihkan.'
            ]);
        } else {
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Gagal memulihkan servis.'
            ]);
        }
        
        return redirect()->to('/master-data/services');
    }
}