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

    // ajax fetches
    $routes->post('spare-parts/fetch', 'SpareParts::fetch');
    $routes->post('services/fetch', 'Services::fetch');
    $routes->post('customers/fetch', 'Customers::fetch');
    $routes->post('mechanics/fetch', 'Mechanics::fetch');
    $routes->post('motorcycles/fetch', 'Motorcycles::fetchByCustomerId');
    $routes->post('suppliers/fetch', 'Suppliers::fetch');
    $routes->post('admins/fetch', 'Admins::fetch');
});

$routes->group('transactions', ['filter' => 'auth'], function ($routes) {
    // sales routes
    $routes->get('sales', 'Sales::index');
    $routes->get('sales/add', 'Sales::add');
    $routes->get('sales/edit/(:num)', 'Sales::edit/$1');
    $routes->post('sales/edit', 'Sales::update');
    $routes->post('sales/delete', 'Sales::delete');
    // save
    $routes->post('sales/save', 'Sales::save');
    // payment management routes
    $routes->post('sales/update', 'Sales::update');
    $routes->post('sales/add_payment', 'Sales::add_payment');
    $routes->post('sales/delete_payment', 'Sales::delete_payment');
    $routes->post('sales/get_payments', 'Sales::get_payments');
    $routes->get('sales/print_invoice/(:num)', 'Sales::print_invoice/$1');
    // Archive management routes
    $routes->get('sales/archived', 'Sales::archived');
    $routes->get('sales/restore/(:num)', 'Sales::restore/$1');

    // purchases routes
    $routes->get('purchases', 'Purchases::index');
    $routes->post('purchases/add', 'Purchases::add');

    // returns routes
    $routes->get('returns', 'Returns::index');
    $routes->get('returns/add', 'Returns::add');
    $routes->post('returns/add', 'Returns::store');
});

// settings routes
$routes->group('settings', ['filter' => 'auth'], function ($routes) {
    // Mechanic Salary Settings routes
    $routes->get('mechanic-salaries', 'MechanicSalarySettings::index');

    // mechanic salary settings routes
    $routes->group('mechanic-salaries', ['namespace' => 'App\Controllers'], function ($routes) {
        $routes->get('/', 'MechanicSalarySettings::index');
        $routes->get('create', 'MechanicSalarySettings::create');
        $routes->post('save', 'MechanicSalarySettings::save');
        $routes->get('edit/(:num)', 'MechanicSalarySettings::edit/$1');
        $routes->post('update/(:num)', 'MechanicSalarySettings::update/$1');
        $routes->get('delete/(:num)', 'MechanicSalarySettings::delete/$1');

        // Salary report routes
        $routes->get('reports', 'MechanicSalarySettings::reports');
        $routes->post('generate-report', 'MechanicSalarySettings::generateReport');
        $routes->post('print-report', 'MechanicSalarySettings::printReport');
    });
});


$routes->group('master-data', ['filter' => 'auth'], function ($routes) {
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
        $routes->get('new', 'SpareParts::new');

        $routes->post('add', 'SpareParts::add');
        $routes->post('edit', 'SpareParts::edit');
        $routes->post('delete', 'SpareParts::delete');
        $routes->get('price-history/(:num)', 'Spareparts::price_history/$1');
        // fetch
        $routes->post('fetch', 'SpareParts::fetch');
    });

    // spare part type routes
    $routes->group('spare-part-types', ['namespace' => 'App\Controllers'], function ($routes) {
        $routes->get('/', 'SparePartTypes::index');
        $routes->post('add', 'SparePartTypes::add');
        $routes->post('edit', 'SparePartTypes::edit');
        $routes->post('delete', 'SparePartTypes::delete');
    });


    // customer routes
    $routes->group('customers', ['namespace' => 'App\Controllers'], function ($routes) {
        $routes->get('/', 'Customers::index');
        // add route with segment
        $routes->post('add', 'Customers::add');
        $routes->post('add-alt', 'Customers::addAlt');
        $routes->post('edit', 'Customers::edit');
        $routes->post('delete', 'Customers::delete');
        $routes->get('archived', 'Customers::archived');
        $routes->get('restore/(:num)', 'Customers::restore/$1');
        // fetch
        $routes->post('fetch', 'Customers::fetch');
    });

    // mechanic routes
    $routes->group('mechanics', ['namespace' => 'App\Controllers'], function ($routes) {
        $routes->get('/', 'Mechanics::index');
        $routes->post('add', 'Mechanics::add');
        $routes->post('edit', 'Mechanics::edit');
        $routes->post('delete', 'Mechanics::delete');
        $routes->get('archived', 'Mechanics::archived');
        $routes->get('restore/(:num)', 'Mechanics::restore/$1');
        // fetch
        $routes->post('fetch', 'Mechanics::fetch');
    });

    // service routes
    $routes->group('services', ['namespace' => 'App\Controllers'], function ($routes) {
        $routes->get('/', 'Services::index');
        $routes->post('add', 'Services::add');
        $routes->post('edit', 'Services::edit');
        $routes->post('delete', 'Services::delete');
        // fetch
        $routes->post('fetch', 'Services::fetch');
    });

    // motorcycle routes
    $routes->group('motorcycles', ['namespace' => 'App\Controllers'], function ($routes) {
        $routes->get('/', 'Motorcycles::index');
        $routes->post('add', 'Motorcycles::add');
        $routes->post('add-alt', 'Motorcycles::addAlt');
        $routes->post('update', 'Motorcycles::update');
        $routes->post('delete', 'Motorcycles::delete');
        // fetch motorcycles
        $routes->post('fetch', 'Motorcycles::fetchByCustomerId');
    });
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



// activity log routes
$routes->group('activity-logs', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'ActivityLogs::index');
});


// Reports routes
$routes->group('reports', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Reports::index');

    // Sales reports
    $routes->get('sales', 'Reports::sales');
    $routes->post('sales/generate', 'Reports::generateSalesReport');
    $routes->post('sales/print', 'Reports::printSalesReport');

    // Mechanic salary reports
    $routes->get('mechanic-salaries', 'Reports::mechanicSalaries');
    $routes->post('mechanic-salaries/generate', 'Reports::generateMechanicSalaryReport');
    $routes->post('mechanic-salaries/print', 'Reports::printMechanicSalaryReport');
});

// role routes
$routes->group('roles', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Roles::index');
    $routes->post('add', 'Roles::add');
    $routes->post('edit', 'Roles::edit');
    $routes->post('delete', 'Roles::delete');
});
