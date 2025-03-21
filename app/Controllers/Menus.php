<?php
// app/Controllers/Menu.php

namespace App\Controllers;

use App\Models\MenuModel;

class Menus extends BaseController
{
    protected $menuModel;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
    }
    

    public function index()
    {
        $data = [
            'title' => 'Data Menu',
            'menus' => $this->menuModel->findAll(),
        ];

        return $this->render('pages/menu/index', $data);
    }

    public function add()
    {
        // get form data
        $formData = [
            'name' => $this->request->getPost('add_name'),
            'url' => $this->request->getPost('add_url'),
            'icon' => $this->request->getPost('add_icon'),
            'is_active' => $this->request->getPost('add_is_active'),
        ];

        // save menu data to database
        $newMenu =  $this->menuModel->save($formData);

        if (!$newMenu) {
            // show error message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Gagal menambahkan menu.'
            ]);

            return redirect()->to(previous_url());
        }

        // show success message and redirect to the previous page. set alert session data
        session()->setFlashdata('alert', [
            'type' => 'success',
            'message' => 'Menu berhasil ditambahkan.'
        ]);

        return redirect()->to(previous_url());
    }

    public function edit($id)
    {
        // get form data
        $formData = [
            'name' => $this->request->getPost('edit_name'),
            'url' => $this->request->getPost('edit_url'),
            'icon' => $this->request->getPost('edit_icon'),
            'is_active' => $this->request->getPost('edit_is_active'),
        ];

        // save menu data to database
        $updateMenu =  $this->menuModel->update($id, $formData);

        if (!$updateMenu) {
            // show error message and redirect to the previous page. set alert session data
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Gagal mengubah menu.'
            ]);

            return redirect()->to(previous_url());
        }

        // show success message and redirect to the previous page. set alert session data
        session()->setFlashdata('alert', [
            'type' => 'success',
            'message' => 'Menu berhasil diubah.'
        ]);

        return redirect()->to(previous_url());
    }
}
