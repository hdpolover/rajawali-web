<?php
// app/Controllers/Dashboard.php

namespace App\Controllers;

use App\Models\ActivityLogModel;
use App\Models\AdminModel;

class ActivityLogs extends BaseController
{
    protected $activityLogModel;
    protected $adminModel;

    public function __construct()
    {
        $this->activityLogModel = new ActivityLogModel();
        $this->adminModel = new AdminModel();
    }

    public function index()
    {
        $data = [
            'title'       => 'Data Aktivitas Admin',
            'activity_logs' => $this->activityLogModel->findAll(),
            'admins' => $this->adminModel->findAll(),
        ];

        // var_dump($data);die;

        return $this->render('pages/activity_log/index', $data);
    }
}