<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    protected $db;

    public function __construct() 
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    /**
     * Get sales summary for today
     * 
     * @return array
     */
    public function getSalesSummaryToday()
    {
        $today = date('Y-m-d');
        $builder = $this->db->table('sales');
        $builder->select('status, COUNT(*) as count');
        $builder->where("DATE(created_at)", $today);
        $builder->groupBy('status');
        
        return $builder->get()->getResult();
    }

    /**
     * Get total sales amount for today
     * 
     * @return object
     */
    public function getTotalSalesToday()
    {
        $today = date('Y-m-d');
        $builder = $this->db->table('sales');
        $builder->select('SUM(total) as total');
        $builder->where("DATE(created_at)", $today);
        $builder->where("status", "completed");
        
        return $builder->get()->getRow();
    }

    /**
     * Get top selling spare parts for today
     *
     * @param int $limit
     * @return array
     */
    public function getTopSellingSparePartsToday($limit = 5)
    {
        $today = date('Y-m-d');
        $builder = $this->db->table('spare_part_sale_details as spsd');
        $builder->select('sp.name, sp.code_number, COUNT(spsd.spare_part_id) as sales_count, SUM(spsd.quantity) as total_quantity');
        $builder->join('spare_parts as sp', 'sp.id = spsd.spare_part_id');
        $builder->join('spare_part_sales as sps', 'sps.id = spsd.spare_part_sale_id');
        $builder->join('sales as s', 's.id = sps.sale_id');
        $builder->where("DATE(s.created_at)", $today);
        $builder->groupBy('spsd.spare_part_id');
        $builder->orderBy('total_quantity', 'DESC');
        $builder->limit($limit);
        
        return $builder->get()->getResult();
    }
    
    /**
     * Get popular services for today
     *
     * @param int $limit
     * @return array
     */
    public function getPopularServicesToday($limit = 5)
    {
        $today = date('Y-m-d');
        $builder = $this->db->table('service_sale_details as ssd');
        $builder->select('s.name, COUNT(ssd.service_id) as service_count');
        $builder->join('services as s', 's.id = ssd.service_id');
        $builder->join('service_sales as ss', 'ss.id = ssd.service_sale_id');
        $builder->join('sales as sl', 'sl.id = ss.sale_id');
        $builder->where("DATE(sl.created_at)", $today);
        $builder->groupBy('ssd.service_id');
        $builder->orderBy('service_count', 'DESC');
        $builder->limit($limit);
        
        return $builder->get()->getResult();
    }
    
    /**
     * Get top mechanics based on services performed today
     *
     * @param int $limit
     * @return array
     */
    public function getTopMechanicsToday($limit = 5)
    {
        $today = date('Y-m-d');
        $builder = $this->db->table('service_sale_details as ssd');
        $builder->select('m.name, COUNT(ssd.mechanic_id) as service_count');
        $builder->join('mechanics as m', 'm.id = ssd.mechanic_id');
        $builder->join('service_sales as ss', 'ss.id = ssd.service_sale_id');
        $builder->join('sales as s', 's.id = ss.sale_id');
        $builder->where("DATE(s.created_at)", $today);
        $builder->groupBy('ssd.mechanic_id');
        $builder->orderBy('service_count', 'DESC');
        $builder->limit($limit);
        
        return $builder->get()->getResult();
    }
    
    /**
     * Get monthly sales trend for the current year
     *
     * @return array
     */
    public function getMonthlySalesTrend()
    {
        $currentYear = date('Y');
        $builder = $this->db->table('sales');
        $builder->select("MONTH(created_at) as month, SUM(total) as total_sales");
        $builder->where("YEAR(created_at)", $currentYear);
        $builder->where("status", "completed");
        $builder->groupBy('MONTH(created_at)');
        $builder->orderBy('MONTH(created_at)', 'ASC');
        
        $results = $builder->get()->getResult();
        
        // Format results for chart display
        $monthlyData = [];
        $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        
        // Initialize with zero values for all months
        foreach ($monthNames as $index => $name) {
            $monthlyData[$index + 1] = [
                'month' => $name,
                'total' => 0
            ];
        }
        
        // Fill in actual data
        foreach ($results as $row) {
            $monthlyData[(int)$row->month]['total'] = (float)$row->total_sales;
        }
        
        return array_values($monthlyData);
    }
    
    /**
     * Get spare parts with low stock (below threshold)
     * 
     * @param int $threshold Stock threshold to consider low
     * @return array
     */
    public function getLowStockSpareParts($threshold = 5)
    {
        $builder = $this->db->table('spare_parts as sp');
        $builder->select('sp.id, sp.name, sp.code_number, spd.current_stock, spd.current_buy_price');
        $builder->join('spare_part_details as spd', 'sp.id = spd.spare_part_id', 'left');
        $builder->where('spd.current_stock <=', $threshold);
        $builder->where('spd.current_stock >', 0); // Exclude out of stock items
        $builder->orderBy('spd.current_stock', 'ASC');
        $builder->limit(10);
        
        return $builder->get()->getResult();
    }
    
    /**
     * Get customer retention statistics
     * 
     * @return array
     */
    public function getCustomerRetentionStats() 
    {
        // Count all customers
        $customerModel = new \App\Models\CustomerModel();
        $totalCustomers = $customerModel->countAll();
        
        // Count returning customers (with more than 1 sale)
        $currentYear = date('Y');
        $builder = $this->db->table('sales');
        $builder->select('customer_id, COUNT(id) as visit_count');
        $builder->where("YEAR(created_at)", $currentYear);
        $builder->groupBy('customer_id');
        $builder->having('visit_count > 1');
        
        $returningCustomers = $builder->countAllResults();
        
        // Calculate retention rate
        $retentionRate = $totalCustomers > 0 ? round(($returningCustomers / $totalCustomers) * 100, 2) : 0;
        
        return [
            'total' => $totalCustomers,
            'returning' => $returningCustomers,
            'rate' => $retentionRate
        ];
    }
    
    /**
     * Get service type distribution
     * 
     * @return array
     */
    public function getServiceTypeDistribution()
    {
        $currentMonth = date('m');
        $currentYear = date('Y');
        
        $builder = $this->db->table('service_sale_details as ssd');
        $builder->select('s.difficulty, COUNT(ssd.id) as count');
        $builder->join('services as s', 's.id = ssd.service_id');
        $builder->join('service_sales as ss', 'ss.id = ssd.service_sale_id');
        $builder->join('sales as sl', 'sl.id = ss.sale_id');
        $builder->where("MONTH(sl.created_at)", $currentMonth);
        $builder->where("YEAR(sl.created_at)", $currentYear);
        $builder->groupBy('s.difficulty');
        
        $results = $builder->get()->getResult();
        
        // Format results for chart display
        $distribution = [
            'easy' => 0,
            'medium' => 0,
            'hard' => 0
        ];
        
        foreach ($results as $row) {
            if (isset($distribution[$row->difficulty])) {
                $distribution[$row->difficulty] = $row->count;
            }
        }
        
        return $distribution;
    }
}