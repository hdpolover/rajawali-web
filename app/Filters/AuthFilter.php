<?php
// app/Filters/AuthFilter.php 

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('login')
                ->with('error', 'Please login to access this page');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}