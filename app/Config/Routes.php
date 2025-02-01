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
    $routes->get('suppliers', 'Suppliers::index');
    $routes->get('spare-parts', 'SpareParts::index');
    $routes->get('admins', 'Admins::index');
    $routes->get('spare-part-types', 'SparePartTypes::index');
    $routes->get('activity-logs', 'ActivityLogs::index');
    // customer routes
    $routes->get('customers', 'Customers::index');
    // role routes
    $routes->get('roles', 'Roles::index');
    // menu routes
    $routes->get('menus', 'Menus::index');
    // mechanics routes
    $routes->get('mechanics', 'Mechanics::index');
    // service routes
    $routes->get('services', 'Services::index');
    // motorcycle routes
    $routes->get('motorcycles', 'Motorcycles::index');
});

$routes->group('transactions', ['filter' => 'auth'], function ($routes) {
    // sales routes
    $routes->get('sales', 'Sales::index');
    $routes->get('sales/add', 'Sales::add');
    $routes->post('sales/add', 'Sales::store');
    $routes->get('sales/edit/(:num)', 'Sales::edit/$1');

    // purchases routes
    $routes->get('purchases', 'Purchases::index');
    $routes->post('purchases/add', 'Purchases::add');

    // returns routes
    $routes->get('returns', 'Returns::index');
    $routes->get('returns/add', 'Returns::add');
    $routes->post('returns/add', 'Returns::store');
});

// supplier routes
$routes->group('suppliers', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Suppliers::index');
    $routes->post('add', 'Suppliers::add');
    $routes->post('edit', 'Suppliers::edit');
    $routes->post('delete', 'Suppliers::delete');
    $routes->post('fetch', 'Suppliers::fetch');
});


// sparepart routes
$routes->group('spare-parts', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'SpareParts::index');
    $routes->post('add', 'SpareParts::add');
    $routes->post('edit', 'SpareParts::edit');
    $routes->post('delete', 'SpareParts::delete');
    $routes->get('price-history/(:num)', 'Spareparts::price_history/$1');
    // fetch
    $routes->post('fetch', 'SpareParts::fetch');
});

// admin routes
$routes->group('admins', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Admins::index');
    $routes->post('add', 'Admins::add');
    $routes->post('edit', 'Admins::edit');
    $routes->post('delete', 'Admins::delete');
});

// menu routes
$routes->group('menus', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Menus::index');
    $routes->post('add', 'Menus::add');
    $routes->post('edit', 'Menus::edit');
    $routes->post('delete', 'Menus::delete');
});

// spare part type routes
$routes->group('spare-part-types', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'SparePartTypes::index');
    $routes->post('add', 'SparePartTypes::add');
    $routes->post('edit', 'SparePartTypes::edit');
    $routes->post('delete', 'SparePartTypes::delete');
});

// activity log routes
$routes->group('activity-logs', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'ActivityLogs::index');
});

// customer routes
$routes->group('customers', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Customers::index');
    $routes->post('add', 'Customers::add');
    $routes->post('edit', 'Customers::edit');
    $routes->post('delete', 'Customers::delete');
    // fetch
    $routes->post('fetch', 'Customers::fetch');
});

// role routes
$routes->group('roles', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Roles::index');
    $routes->post('add', 'Roles::add');
    $routes->post('edit', 'Roles::edit');
    $routes->post('delete', 'Roles::delete');
});

// mechanic routes
$routes->group('mechanics', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Mechanics::index');
    $routes->post('add', 'Mechanics::add');
    $routes->post('edit', 'Mechanics::edit');
    $routes->post('delete', 'Mechanics::delete');
});

// service routes
$routes->group('services', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Services::index');
    $routes->post('add', 'Services::add');
    $routes->post('edit', 'Services::edit');
    $routes->post('delete', 'Services::delete');
});

// motorcycle routes
$routes->group('motorcycles', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Motorcycles::index');
    $routes->post('add', 'Motorcycles::add');
    $routes->post('edit', 'Motorcycles::edit');
    $routes->post('delete', 'Motorcycles::delete');
});
