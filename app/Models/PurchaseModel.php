<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\PurchasePaymentModel;


class PurchaseModel extends Model
{
    protected $table = 'purchases';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';

    protected $allowedFields = [
        'supplier_id',
        'description',
        'admin_id',
        'total',
        'status',
        'purchase_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [

        'supplier_id' => 'required',
        'description' => 'required',
        'total' => 'required|numeric',
    ];

    protected $validationMessages = [
        'supplier_id' => [
            'required' => 'Supplier wajib diisi'
        ],
        'description' => [
            'required' => 'Deskripsi wajib diisi'
        ],
        'total' => [
            'required' => 'Total wajib diisi',
            'numeric' => 'Total harus berupa angka'
        ]
    ];

    public function getPurchases($id = null)
    {
        if ($id == null) {
            // builder
            $builder = $this->db->table('purchases');
            // get purchases
            $builder->select('purchases.*');

            // Execute the query and get the result as an array of objects
            $purchaseResults = $builder->get()->getResult();

            // create an array of purchase objects
            $purchases = [];

            // loop through the results and create purchase objects
            foreach ($purchaseResults as $purchase) {
                // get the supplier
                $supplierModel = new SupplierModel();
                $supplier = $supplierModel->find($purchase->supplier_id);
                // set the supplier
                $purchase->supplier = $supplier;

                // get the admin
                $adminModel = new AdminModel();
                $admin = $adminModel->find($purchase->admin_id);
                // set the admin
                $purchase->admin = $admin;

                // get the purchase details
                $purchaseDetailModel = new PurchaseDetailModel();
                $purchaseDetails = $purchaseDetailModel->where('purchase_id', $purchase->id)->findAll();

                // get spare part details
                $sparePartModel = new SparePartModel();

                foreach ($purchaseDetails as $purchaseDetail) {
                    $sparePart = $sparePartModel->find($purchaseDetail->spare_part_id);
                    $purchaseDetail->spare_part = $sparePart;
                }

                // set the purchase details
                $purchase->details = $purchaseDetails;

                // get the purchase payment
                $purchasePaymentModel = new PurchasePaymentModel();

                $purchasePayment = $purchasePaymentModel->where('purchase_id', $purchase->id)->first();

                // get the purchase payment details
                $purchasePaymentDetailModel = new PurchasePaymentDetailModel();

                $purchasePaymentDetails = $purchasePaymentDetailModel->where('purchase_payment_id', $purchasePayment->id)->findAll();

                // set the purchase payment details
                $purchasePayment->details = $purchasePaymentDetails;

                // set the purchase payment
                $purchase->payment = $purchasePayment;

                // add the purchase object to the array
                $purchases[] = $purchase;
            }

            return $purchases;
        } else {
            // Perform the query to join purchases with suppliers and admins
            $builder = $this->db->table('purchases');
            $builder->select('purchases.*, suppliers.name as supplier_name, admins.name as admin_name');
            $builder->join('suppliers', 'purchases.supplier_id = suppliers.id', 'left');
            $builder->join('admins', 'purchases.admin_id = admins.id', 'left');
            $builder->where('purchases.id', $id);

            // Execute the query and get the result as an object
            $purchase = $builder->get()->getRow();

            if (!$purchase) {
                return null;
            }

            // get the supplier
            $supplierModel = new SupplierModel();
            $supplier = $supplierModel->find($purchase->supplier_id);
            // set the supplier
            $purchase->supplier = $supplier;

            // get the admin
            $adminModel = new AdminModel();
            $admin = $adminModel->find($purchase->admin_id);
            // set the admin
            $purchase->admin = $admin;

            // get the purchase details
            $purchaseDetailModel = new PurchaseDetailModel();
            $purchaseDetails = $purchaseDetailModel->where('purchase_id', $purchase->id)->findAll();
            // set the purchase details
            $purchase->details = $purchaseDetails;

            return $purchase;
        }
    }

    function savePurchase($data)
    {
        // save the purchase
        $this->save($data);

        // get the purchase id
        $purchaseId = $this->insertID();

        // get the spare parts
        $spareParts = $data['spare_parts'];

        // loop through the spare parts and save the purchase details
        foreach ($spareParts as $sparePart) {
            $purchaseDetailModel = new PurchaseDetailModel();

            $purchaseDetailModel->save([
                'purchase_id' => $purchaseId,
                'spare_part_id' => $sparePart['spare_part_id'],
                'quantity' => $sparePart['quantity'],
                'buy_price' => $sparePart['buy_price'],
                'sub_total' => $sparePart['sub_total'],
            ]);

            // get the spare part details
            $sparePartDetailModel = new SparePartDetailModel();

            $sparePartDetail = $sparePartDetailModel->where('spare_part_id', $sparePart['spare_part_id'])->first();

            // if price is different, add price history
            if ($sparePartDetail->current_buy_price != $sparePart['buy_price'] || $sparePartDetail->current_sell_price != $sparePart['sell_price']) {
                $sparePartPriceHistoryModel = new SparePartPriceHistoryModel();

                $sparePartPriceHistoryModel->save([
                    'spare_part_id' => $sparePart['spare_part_id'],
                    'old_buy_price' => $sparePartDetail->current_buy_price,
                    'old_sell_price' => $sparePartDetail->current_sell_price,
                    'new_buy_price' => $sparePart['buy_price'],
                    'new_sell_price' => $sparePart['sell_price'],
                    'change_date' => date('Y-m-d H:i:s'),
                ]);
            }

            // update the spare part detail current stock
            $newStock = $sparePartDetail->current_stock + $sparePart['quantity'];

            // update the spare part detail current prices
            $sparePartDetailModel->update($sparePartDetail->id, [
                'current_stock' => $newStock,
                'current_buy_price' => $sparePart['buy_price'],
                'current_sell_price' => $sparePart['sell_price'],
            ]);
        }

        // save purchase payment
        $purchasePaymentModel = new PurchasePaymentModel();

        $purchasePaymentModel->save([
            'purchase_id' => $purchaseId,
            'status' => $data['payment']['status'],
            'total' => $data['total'],
            'description' => $data['payment']['description'],
        ]);

        // get the last inserted id
        $purchasePaymentId = $purchasePaymentModel->insertID();

        // save purchase payment details
        $purchasePaymentDetailModel = new PurchasePaymentDetailModel();

        $purchasePaymentDetailModel->save([
            'purchase_payment_id' => $purchasePaymentId,
            'payment_date' => $data['payment']['payment_date'],
            'payment_type' => $data['payment']['payment_method'],
            'status' => $data['payment']['status'],
            'sub_total' => $data['payment']['sub_total'],
            'description' => $data['payment']['description'],
        ]);

        return $purchaseId;
    }
}
