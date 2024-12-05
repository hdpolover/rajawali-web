<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Auth Routes
$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

// Default route - check auth
$routes->get('/', static function () {
    if (!session()->get('logged_in')) {
        return redirect()->to('login');
    }
    return redirect()->to('dashboard');
});

// Protected Routes
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    // Add other protected routes here
});

$routes->group('transactions', ['filter' => 'auth'], function($routes) {
    $routes->get('sales', 'Transaction::sales');
    $routes->get('incoming', 'Transaction::incoming');
});
