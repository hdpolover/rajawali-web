<?php

namespace App\Models;

use CodeIgniter\Model;

class MechanicSalarySettingModel extends Model
{
    protected $table = 'mechanic_salary_settings';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['mechanic_id', 'percentage', 'status', 'description'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    
    /**
     * Get mechanic salary settings with mechanic details
     * 
     * @param int|null $id Optional ID to get specific record
     * @return array
     */
    public function getSalarySettings($id = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('mechanic_salary_settings.*, mechanics.name as mechanic_name');
        $builder->join('mechanics', 'mechanics.id = mechanic_salary_settings.mechanic_id');
        
        if ($id) {
            $builder->where('mechanic_salary_settings.id', $id);
            return $builder->get()->getRow();
        }
        
        return $builder->get()->getResult();
    }
    
    /**
     * Get active salary setting for a specific mechanic
     * 
     * @param int $mechanicId
     * @return object|null
     */
    public function getActiveSetting($mechanicId)
    {
        return $this->where('mechanic_id', $mechanicId)
                    ->where('status', 'active')
                    ->first();
    }
    
    /**
     * Calculate mechanic's salary based on service price
     * 
     * @param int $mechanicId
     * @param float $servicePrice
     * @return float
     */
    public function calculateSalary($mechanicId, $servicePrice)
    {
        $setting = $this->getActiveSetting($mechanicId);
        
        if ($setting) {
            return ($setting->percentage / 100) * $servicePrice;
        }
        
        // Default to 0 if no setting found
        return 0;
    }
    
    /**
     * Calculate mechanic salaries for a given time period
     * 
     * @param string $startDate Format: Y-m-d
     * @param string $endDate Format: Y-m-d
     * @param int|null $mechanicId Optional specific mechanic
     * @return array
     */
    public function calculateSalariesForPeriod($startDate, $endDate, $mechanicId = null)
    {
        $db = \Config\Database::connect();
        $salaries = [];
        
        // Query to get relevant service sales with mechanic details
        $builder = $db->table('service_sales');
        $builder->select('service_sales.id, service_sales.sale_id, service_sales.mechanic_id, 
                          service_sales.service_id, service_sales.price as service_price, 
                          service_sales.created_at, mechanics.name as mechanic_name, 
                          services.name as service_name');
        $builder->join('mechanics', 'mechanics.id = service_sales.mechanic_id');
        $builder->join('services', 'services.id = service_sales.service_id');
        $builder->where('service_sales.deleted_at IS NULL');
        $builder->where('service_sales.created_at >=', $startDate . ' 00:00:00');
        $builder->where('service_sales.created_at <=', $endDate . ' 23:59:59');
        
        if ($mechanicId) {
            $builder->where('service_sales.mechanic_id', $mechanicId);
        }
        
        $query = $builder->get();
        $serviceSales = $query->getResult();
        
        // Group by mechanic for the calculation
        $mechanicSales = [];
        foreach ($serviceSales as $sale) {
            if (!isset($mechanicSales[$sale->mechanic_id])) {
                $mechanicSales[$sale->mechanic_id] = [
                    'mechanic_id' => $sale->mechanic_id,
                    'mechanic_name' => $sale->mechanic_name,
                    'total_service_amount' => 0,
                    'sales' => []
                ];
            }
            
            $mechanicSales[$sale->mechanic_id]['total_service_amount'] += $sale->service_price;
            $mechanicSales[$sale->mechanic_id]['sales'][] = $sale;
        }
        
        // Calculate salary based on the percentage setting
        foreach ($mechanicSales as $mechId => $data) {
            $setting = $this->getActiveSetting($mechId);
            $percentage = $setting ? $setting->percentage : 0;
            $commission = ($percentage / 100) * $data['total_service_amount'];
            
            $salaries[] = [
                'mechanic_id' => $mechId,
                'mechanic_name' => $data['mechanic_name'],
                'total_service_amount' => $data['total_service_amount'],
                'percentage' => $percentage,
                'commission' => $commission,
                'sales' => $data['sales']
            ];
        }
        
        return $salaries;
    }
    
    /**
     * Generate mechanic salary report
     * 
     * @param string $startDate Format: Y-m-d
     * @param string $endDate Format: Y-m-d
     * @param int|null $mechanicId Optional specific mechanic
     * @return array
     */
    public function generateSalaryReport($startDate, $endDate, $mechanicId = null)
    {
        $salaries = $this->calculateSalariesForPeriod($startDate, $endDate, $mechanicId);
        
        $summary = [
            'period_start' => $startDate,
            'period_end' => $endDate,
            'total_mechanics' => count($salaries),
            'total_service_amount' => 0,
            'total_commission' => 0,
            'details' => $salaries
        ];
        
        // Calculate totals
        foreach ($salaries as $salary) {
            $summary['total_service_amount'] += $salary['total_service_amount'];
            $summary['total_commission'] += $salary['commission'];
        }
        
        return $summary;
    }
}