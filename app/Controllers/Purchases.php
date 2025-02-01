<?php

namespace App\Controllers;

use App\Models\PurchaseModel;
use App\Models\SupplierModel;
use App\Models\SparePartModel;


class Purchases extends BaseController
{
    protected $purchaseModel;
    protected $supplierModel;
    protected $sparePartModel;

    public function __construct()
    {
        $this->purchaseModel = new PurchaseModel();
        $this->supplierModel = new SupplierModel();
        $this->sparePartModel = new SparePartModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Pembelian Spare Part',
            'purchases' => $this->purchaseModel->getPurchases(),
        ];

        // var_dump($data['purchases'][0]->toArray());

        return $this->render('pages/transactions/purchases/index', $data);
    }

    public function add()
    {
        $formData = $this->request->getPost();

        $supplierId = $formData['select_supplier'];
        $purchaseDate = $formData['purchase_date'];
        $status = $formData['status'];
        $description = $formData['description'];
        $total = $formData['total'];

        $payment = [
            'payment_date' => $formData['payment_date'],
            'payment_method' => $formData['payment_method'],
            'status' => $formData['payment_status'],
            'sub_total' => $formData['payment_amount'],
            'description' => $formData['payment_description'],
        ];

        $spareParts = [];

        // loop through spare part ids and assign the quantity, sell price, and buy price based on spare part id index
        foreach ($formData['spare_part_ids'] as $index => $sparePartId) {
            $spareParts[] = [
                'spare_part_id' => $sparePartId,
                'quantity' => $formData['quantities'][$index],
                'sell_price' => $formData['sell_prices'][$index],
                'buy_price' => $formData['buy_prices'][$index],
                'sub_total' => $formData['sub_totals'][$index],
            ];
        }

        $data = [
            'supplier_id' => $supplierId,
            'purchase_date' => $purchaseDate,
            'status' => $status,
            'description' => $description,
            'total' => $total,
            'spare_parts' => $spareParts,
            'admin_id' => session()->get('admin_id'),
            'payment' => $payment,
        ];

        // log to console
        //  var_dump($data);

        // save the purchase
        $purchaseId = $this->purchaseModel->savePurchase($data);

        if ($purchaseId) {
             // add activity log
             $logData = [
                'admin_id' => session()->get('admin_id'),
                'table_name' => 'purchases',
                'action' => 'add',
                'old_value' => null,
                'new_value' => $purchaseId,
            ];

            $this->activityLogModel->saveActivityLog($logData);

            // show success message
            session()->setFlashdata('alert', [
                'type' => 'success',
                'message' => 'Pembelian Spare Part berhasil ditambahkan',
            ]);

            return redirect()->to('/transactions/purchases');

        } else {
            // show error message
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Pembelian Spare Part gagal ditambahkan',
            ]);

            return redirect()->to('/transactions/purchases');
        }
    }
}
