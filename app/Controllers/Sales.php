<?php

namespace App\Controllers;

use App\Models\SaleModel;
use App\Models\SparePartModel;
use App\Models\ServiceModel;
use App\Models\MechanicModel;
use App\Models\MotorcycleModel;
use App\Models\SparePartSaleModel;
use App\Models\ServiceSaleModel;
use App\Models\SparePartSaleDetailModel;
use App\Models\ServiceSaleDetailModel;
use App\Models\SparePartDetailModel;
use App\Models\SalePaymentModel;
use App\Models\SalePaymentDetailModel;

class Sales extends BaseController
{
    protected $saleModel;
    protected $sparePartModel;
    protected $serviceModel;
    protected $mechanicModel;
    protected $motorcycleModel;
    protected $sparePartSaleModel;
    protected $serviceSaleModel;
    protected $sparePartSaleDetailModel;
    protected $serviceSaleDetailModel;
    protected $sparePartDetailModel;
    protected $salePaymentModel;
    protected $salePaymentDetailModel;

    public function __construct()
    {
        // Load the sale model
        $this->saleModel = new SaleModel();
        // Load the spare part model
        $this->sparePartModel = new SparePartModel();
        // Load the service model
        $this->serviceModel = new ServiceModel();
        // Load the mechanic model
        $this->mechanicModel = new MechanicModel();
        // Load the motorcycle model
        $this->motorcycleModel = new MotorcycleModel();
        // Load the spare part sale model
        $this->sparePartSaleModel = new SparePartSaleModel();
        // Load the service sale model
        $this->serviceSaleModel = new ServiceSaleModel();
        // Load the spare part sale detail model
        $this->sparePartSaleDetailModel = new SparePartSaleDetailModel();
        // Load the service sale detail model
        $this->serviceSaleDetailModel = new ServiceSaleDetailModel();
        // Load the spare part detail model
        $this->sparePartDetailModel = new SparePartDetailModel();
        // Load the sale payment model
        $this->salePaymentModel = new SalePaymentModel();
        // Load the sale payment detail model
        $this->salePaymentDetailModel = new SalePaymentDetailModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Penjualan',
            // Get all sales data
            'sales' => $this->saleModel->getSales(),
        ];


        return $this->render('pages/transactions/sales/index', $data);
    }

    // save sale data
    public function save()
    {
        $postData = $this->request->getPost();

        // get sale type
        $saleType = $postData['sale_type'];

        $saleData = [];

        if ($saleType === 'complete') {
            // $sale data
            $saleData = [
                'sale_number' => $postData['sale_number'],
                'sale_date' => $postData['sale_date'],
                'customer_id' => $postData['customer_id'],
                'motorcycle_id' => $postData['motorcycle_id'],
                'admin_id' => session()->get('admin_id'),
                'discount' => $postData['discount'],
                'total' => $postData['total'],
                'description' => $postData['description'],
                'status' => 'pending',
            ];
        } else {
            // get form data complete
            $saleData = [
                'sale_number' => $postData['sale_number'],
                'sale_date' => $postData['sale_date'],
                'customer_id' => null,
                'motorcycle_id' => null,
                'admin_id' => session()->get('admin_id'),
                'discount' => $postData['discount'],
                'total' => $postData['total'],
                'description' => $postData['description'],
                'status' => 'pending',
            ];
        }

        // save sale
        $this->saleModel->save($saleData);

        // get the last inserted sale id
        $saleId = $this->saleModel->getInsertID();

        // decode spare parts data
        $spareParts = json_decode($postData['spare_parts'], true);

        // save sale details
        // check if spare parts data is not empty
        if (!empty($spareParts)) {
            $sparePartData = [];

            $sparePartTotal = 0;

            // loop through spare parts data
            foreach ($spareParts as $sparePart) {
                $sparePartData[] = [
                    'spare_part_id' => $sparePart['spare_part_id'],
                    'quantity' => $sparePart['quantity'],
                    'price' => $sparePart['price'],
                    'sub_total' => $sparePart['sub_total'],
                    'description' => $sparePart['description'],
                ];

                $sparePartTotal += $sparePart['sub_total'];
            }


            // save spare part sales
            $this->sparePartSaleModel->save([
                'sale_id' => $saleId,
                'total' => $sparePartTotal,
                'description' => '-',
            ]);

            // get the last inserted spare part sale id
            $sparePartSaleId = $this->sparePartSaleModel->getInsertID();

            // save spare part sale details
            foreach ($sparePartData as $sparePart) {
                $this->sparePartSaleDetailModel->save([
                    'spare_part_sale_id' => $sparePartSaleId,
                    'spare_part_id' => $sparePart['spare_part_id'],
                    'quantity' => $sparePart['quantity'],
                    'price' => $sparePart['price'],
                    'sub_total' => $sparePart['sub_total'],
                    'description' => $sparePart['description'],
                ]);

                // update spare part stock
                $this->sparePartDetailModel->updateStock($sparePart['spare_part_id'], $sparePart['quantity']);
            }
        }

        // decode services data
        $services = json_decode($postData['services'], true);

        // check if services data is not empty
        if (!empty($services)) {
            $serviceData = [];

            $serviceTotal = 0;

            // loop through services data
            foreach ($services as $service) {
                $serviceData[] = [
                    'service_id' => $service['service_id'],
                    'mechanic_id' => $service['mechanic_id'],
                    'price' => $service['price'],
                    'description' => $service['description'],
                    'sub_total' => $service['sub_total'],
                ];

                $serviceTotal += $service['sub_total'];
            }

            // save service sales
            $this->serviceSaleModel->save([
                'sale_id' => $saleId,
                'total' => $serviceTotal,
                'description' => '-',
            ]);

            // get the last inserted service sale id
            $serviceSaleId = $this->serviceSaleModel->getInsertID();

            // save service sale details
            foreach ($serviceData as $service) {
                $this->serviceSaleDetailModel->save([
                    'service_sale_id' => $serviceSaleId,
                    'service_id' => $service['service_id'],
                    'mechanic_id' => $service['mechanic_id'],
                    'price' => $service['price'],
                    'quantity' => 1,    // default quantity is 1
                    'sub_total' => $service['sub_total'],
                    'description' => $service['description'],
                ]);
            }
        }

        // show success message and redirect to the previous page. set alert session data
        session()->setFlashdata('alert', [
            'type' => 'success',
            'message' => 'Data penjualan berhasil ditambahkan',
        ]);

        // add activity log
        $logData = [
            'admin_id' => session()->get('admin_id'),
            'table_name' => 'sales',
            'action_type' => 'add',
            'old_value' => null,
            'new_value' => $postData['sale_date'],
        ];

        $this->activityLogModel->saveActivityLog($logData);

        return redirect()->to('/transactions/sales');
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Penjualan Baru',
            'spare_parts' => $this->sparePartModel->getWithPriceDetails(),
            'services' => $this->serviceModel->getServices(),
            'mechanics' => $this->mechanicModel->findAll(),
            'motorcycles' => $this->motorcycleModel->getMotorcycles(),
        ];

        return $this->render('pages/transactions/sales/new', $data);
    }

    /**
     * Update sale data
     */
    public function update()
    {
        // Get request data
        $postData = $this->request->getPost();
        
        // Validate required data
        if (!isset($postData['id']) || !is_numeric($postData['id'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'ID penjualan tidak valid'
            ]);
        }
        
        // Get sale data
        $sale = $this->saleModel->find($postData['id']);
        
        if (!$sale) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data penjualan tidak ditemukan'
            ]);
        }
        
        // Prepare update data
        $updateData = [
            'id' => $postData['id'],
            'status' => $postData['status'],
            'discount' => $postData['discount'],
            'description' => $postData['description']
        ];
        
        // Store old values for activity log
        $oldSale = $this->saleModel->find($postData['id']);
        
        // Save sale updates
        $this->saleModel->save($updateData);
        
        // Update payment status if there are payments
        $payment = $this->salePaymentModel->where('sale_id', $postData['id'])->first();
        
        if ($payment) {
            // Get all payment details
            $paymentDetails = $this->salePaymentDetailModel->where('sale_payment_id', $payment->id)->findAll();
            
            if ($paymentDetails) {
                foreach ($paymentDetails as $detail) {
                    // Check if status is updated
                    $newStatus = $postData['payment_status_' . $detail->id] ?? null;
                    
                    if ($newStatus && $newStatus !== $detail->status) {
                        $this->salePaymentDetailModel->update($detail->id, [
                            'status' => $newStatus
                        ]);
                    }
                }
            }
        }
        
        // Add activity log
        $logData = [
            'admin_id' => session()->get('admin_id'),
            'table_name' => 'sales',
            'action_type' => 'edit',
            'old_value' => json_encode($oldSale),
            'new_value' => json_encode($updateData),
        ];
        
        $this->activityLogModel->saveActivityLog($logData);
        
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data penjualan berhasil diperbarui'
        ]);
    }
    
    /**
     * Add payment to sale
     */
    public function add_payment()
    {
        $postData = $this->request->getPost();
        
        // Validate required data
        if (!isset($postData['sale_id']) || !is_numeric($postData['sale_id'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'ID penjualan tidak valid'
            ]);
        }
        
        if (!isset($postData['amount']) || !is_numeric($postData['amount']) || $postData['amount'] <= 0) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Jumlah pembayaran tidak valid'
            ]);
        }
        
        // Get sale data
        $sale = $this->saleModel->find($postData['sale_id']);
        
        if (!$sale) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data penjualan tidak ditemukan'
            ]);
        }
        
        // Check or create payment record for this sale
        $payment = $this->salePaymentModel->where('sale_id', $postData['sale_id'])->first();
        
        if (!$payment) {
            // Create new payment record
            $this->salePaymentModel->save([
                'sale_id' => $postData['sale_id'],
                'total' => $postData['amount'],
                'status' => 'pending'
            ]);
            
            $paymentId = $this->salePaymentModel->getInsertID();
        } else {
            $paymentId = $payment->id;
            
            // Update the total
            $this->salePaymentModel->update($paymentId, [
                'total' => $payment->total + $postData['amount']
            ]);
        }
        
        // Make sure payment method is not empty
        $paymentMethod = !empty($postData['payment_method']) ? $postData['payment_method'] : 'cash';

        // Add payment detail
        $paymentDetail = [
            'sale_payment_id' => $paymentId,
            'payment_method' => $paymentMethod,
            'amount' => $postData['amount'],
            'payment_date' => $postData['payment_date'],
            'status' => $postData['status'],
            'description' => !empty($postData['description']) ? $postData['description'] : '',
            'proof' => 'default.jpg'
        ];
        
        $this->salePaymentDetailModel->save($paymentDetail);
        
        // If status is completed, check if the total payment equals the sale total
        if ($postData['status'] === 'completed') {
            // Get all payment details
            $paymentDetails = $this->salePaymentDetailModel
                ->where('sale_payment_id', $paymentId)
                ->where('status', 'completed')
                ->findAll();
            
            $totalPaid = 0;
            foreach ($paymentDetails as $detail) {
                $totalPaid += $detail->amount;
            }
            
            // Check if payment is complete
            $saleTotal = $sale->total;
            
            if ($totalPaid >= $saleTotal) {
                // Update sale status to completed
                $this->saleModel->update($sale->id, [
                    'status' => 'completed'
                ]);
                
                // Update payment status to completed
                $this->salePaymentModel->update($paymentId, [
                    'status' => 'completed'
                ]);
            } else {
                // Update sale status to process
                $this->saleModel->update($sale->id, [
                    'status' => 'process'
                ]);
            }
        }
        
        // Add activity log
        $logData = [
            'admin_id' => session()->get('admin_id'),
            'table_name' => 'sale_payment_details',
            'action_type' => 'add',
            'old_value' => null,
            'new_value' => json_encode($paymentDetail),
        ];
        
        $this->activityLogModel->saveActivityLog($logData);
        
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Pembayaran berhasil ditambahkan'
        ]);
    }
    
    /**
     * Delete payment
     */
    public function delete_payment()
    {
        $postData = $this->request->getPost();
        
        // Validate required data
        if (!isset($postData['id']) || !is_numeric($postData['id'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'ID pembayaran tidak valid'
            ]);
        }
        
        // Get payment detail
        $paymentDetail = $this->salePaymentDetailModel->find($postData['id']);
        
        if (!$paymentDetail) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data pembayaran tidak ditemukan'
            ]);
        }
        
        // Get payment and sale
        $payment = $this->salePaymentModel->find($paymentDetail->sale_payment_id);
        
        if (!$payment) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data pembayaran utama tidak ditemukan'
            ]);
        }
        
        // Store old values for activity log
        $oldPaymentDetail = $paymentDetail;
        
        // Delete payment detail
        $this->salePaymentDetailModel->delete($postData['id']);
        
        // Update the total payment
        $this->salePaymentModel->update($payment->id, [
            'total' => $payment->total - $paymentDetail->amount
        ]);
        
        // Get remaining payment details
        $remainingPayments = $this->salePaymentDetailModel
            ->where('sale_payment_id', $payment->id)
            ->where('status', 'completed')
            ->findAll();
        
        // Calculate total paid
        $totalPaid = 0;
        foreach ($remainingPayments as $detail) {
            $totalPaid += $detail->amount;
        }
        
        // Get sale
        $sale = $this->saleModel->find($payment->sale_id);
        
        // Update sale status based on remaining payments
        if ($totalPaid == 0) {
            $this->saleModel->update($sale->id, [
                'status' => 'pending'
            ]);
            $this->salePaymentModel->update($payment->id, [
                'status' => 'pending'
            ]);
        } else if ($totalPaid < $sale->total) {
            $this->saleModel->update($sale->id, [
                'status' => 'process'
            ]);
        }
        
        // Add activity log
        $logData = [
            'admin_id' => session()->get('admin_id'),
            'table_name' => 'sale_payment_details',
            'action_type' => 'delete',
            'old_value' => json_encode($oldPaymentDetail),
            'new_value' => null,
        ];
        
        $this->activityLogModel->saveActivityLog($logData);
        
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Pembayaran berhasil dihapus'
        ]);
    }
    
    /**
     * Get payment details
     */
    public function get_payments()
    {
        $saleId = $this->request->getPost('sale_id');
        
        if (!$saleId || !is_numeric($saleId)) {
            return $this->response->setJSON([]);
        }
        
        // Get payment
        $payment = $this->salePaymentModel->where('sale_id', $saleId)->first();
        
        if (!$payment) {
            return $this->response->setJSON([]);
        }
        
        // Get payment details
        $paymentDetails = $this->salePaymentDetailModel->where('sale_payment_id', $payment->id)->findAll();
        
        if (!$paymentDetails) {
            return $this->response->setJSON([]);
        }
        
        // Convert object to array with proper property checks
        $result = [];
        foreach ($paymentDetails as $detail) {
            $result[] = [
                'id' => $detail->id,
                'sale_payment_id' => $detail->sale_payment_id,
                'payment_method' => $detail->payment_method ?? 'cash',
                'amount' => $detail->amount,
                'payment_date' => $detail->payment_date,
                'status' => $detail->status,
                'description' => $detail->description ?? '',
                'proof' => $detail->proof
            ];
        }
        
        return $this->response->setJSON($result);
    }

    /**
     * Delete sale (soft delete)
     */
    public function delete()
    {
        // Get sale id from post data
        $saleId = $this->request->getPost('id');
        
        if (!$saleId || !is_numeric($saleId)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'ID penjualan tidak valid'
            ]);
        }
        
        // Get the sale data before deletion
        $sale = $this->saleModel->find($saleId);
        
        if (!$sale) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data penjualan tidak ditemukan'
            ]);
        }
        
        // Store old values for activity log
        $oldSale = $sale;
        
        // Soft delete the sale
        $this->saleModel->delete($saleId);
        
        // Add activity log
        $logData = [
            'admin_id' => session()->get('admin_id'),
            'table_name' => 'sales',
            'action_type' => 'delete',
            'old_value' => json_encode($oldSale),
            'new_value' => null,
        ];
        
        $this->activityLogModel->saveActivityLog($logData);
        
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data penjualan berhasil dihapus'
        ]);
    }
    
    /**
     * Show archived/deleted sales
     */
    public function archived()
    {
        $data = [
            'title' => 'Data Penjualan Diarsipkan',
            // Get deleted sales data with onlyDeleted() scope
            'sales' => $this->saleModel->onlyDeleted()->getSales(),
        ];

        return $this->render('pages/transactions/sales/archived', $data);
    }
    
    /**
     * Restore deleted sale
     */
    public function restore($id = null)
    {
        if (!$id || !is_numeric($id)) {
            session()->setFlashdata('alert', [
                'type' => 'error',
                'message' => 'ID penjualan tidak valid'
            ]);
            return redirect()->to('/transactions/sales/archived');
        }
        
        // Find the deleted sale
        $sale = $this->saleModel->onlyDeleted()->find($id);
        
        if (!$sale) {
            session()->setFlashdata('alert', [
                'type' => 'error',
                'message' => 'Data penjualan tidak ditemukan'
            ]);
            return redirect()->to('/transactions/sales/archived');
        }
        
        // Restore the sale
        $this->saleModel->update($id, ['deleted_at' => null]);
        
        // Add activity log
        $logData = [
            'admin_id' => session()->get('admin_id'),
            'table_name' => 'sales',
            'action_type' => 'restore',
            'old_value' => null,
            'new_value' => json_encode($sale),
        ];
        
        $this->activityLogModel->saveActivityLog($logData);
        
        session()->setFlashdata('alert', [
            'type' => 'success',
            'message' => 'Data penjualan berhasil dipulihkan'
        ]);
        
        return redirect()->to('/transactions/sales/archived');
    }
}
