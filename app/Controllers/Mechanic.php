<?php
// app/Controllers/Dashboard.php

namespace App\Controllers;

class Mechanic extends BaseController
{
    public function index()
    {
        $data = [
            'title'       => 'Mekanik',
            'username'    => $this->session->get('username'),
            'role'        => $this->session->get('role'),
            'breadcrumbs' => $this->getBreadcrumbs(),
        ];

        return view('pages/mechanic/mechanic', $data);
    }

    public function search()
    {
         // Dummy data for mechanics
         $mechanics = [
            ['id' => 1, 'text' => 'Mike Brown'],
            ['id' => 2, 'text' => 'Sara White'],
            ['id' => 3, 'text' => 'Tom Black'],
        ];

        return $this->response->setJSON($mechanics);
   
    }
}