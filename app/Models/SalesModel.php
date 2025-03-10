<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesModel extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'invoice_number', 'customer_id', 'date', 'total_amount', 
        'discount', 'tax', 'grand_total', 'payment_status', 'notes',
        'created_by', 'updated_by', 'deleted_at'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $useSoftDeletes = true;
    protected $deletedField = 'deleted_at';

    public function generateSalesReport($startDate, $endDate, $customerId = null)
    {
        $builder = $this->db->table('sales s');
        $builder->select('s.id, s.invoice_number, s.date, s.total_amount, s.discount, s.tax, s.grand_total, s.payment_status, c.name as customer_name');
        $builder->join('customers c', 'c.id = s.customer_id');
        $builder->where('s.date >=', $startDate);
        $builder->where('s.date <=', $endDate);
        
        if ($customerId) {
            $builder->where('s.customer_id', $customerId);
        }
        
        $builder->orderBy('s.date', 'ASC');
        
        $query = $builder->get();
        $salesData = $query->getResult();
        
        // Calculate summary data
        $summaryData = [
            'total_sales' => count($salesData),
            'total_amount' => 0,
            'total_discount' => 0,
            'total_tax' => 0,
            'total_grand_total' => 0,
            'paid_sales' => 0,
            'unpaid_sales' => 0,
            'partial_sales' => 0
        ];
        
        foreach ($salesData as $sale) {
            $summaryData['total_amount'] += $sale->total_amount;
            $summaryData['total_discount'] += $sale->discount;
            $summaryData['total_tax'] += $sale->tax;
            $summaryData['total_grand_total'] += $sale->grand_total;
            
            if ($sale->payment_status === 'paid') {
                $summaryData['paid_sales']++;
            } elseif ($sale->payment_status === 'unpaid') {
                $summaryData['unpaid_sales']++;
            } else {
                $summaryData['partial_sales']++;
            }
        }
        
        return [
            'sales' => $salesData,
            'summary' => $summaryData,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'customer_id' => $customerId
        ];
    }
}