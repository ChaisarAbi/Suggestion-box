<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'DashboardController::index');
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::attemptLogin');
$routes->get('/logout', 'AuthController::logout');

// Protected Routes
$routes->group('', ['filter' => 'auth'], function($routes) {
    // Kotak Saran - User
    $routes->group('', ['filter' => 'auth:user'], function($routes) {
        $routes->get('/user/dashboard', 'DashboardController::user');
        $routes->get('/kotak-saran', 'KotakSaranController::index');
        $routes->get('/kotak-saran/create', 'KotakSaranController::create');
        $routes->post('/kotak-saran/store', 'KotakSaranController::store');
        $routes->get('/kotak-saran/(:num)', 'KotakSaranController::show/$1');

        // Routes untuk tanggapan
        $routes->post('/tanggapan/(:num)', 'TanggapanController::create/$1');
        $routes->get('/tanggapan/(:num)', 'TanggapanController::show/$1');
    });

    // Admin Routes
    $routes->group('', ['filter' => 'auth:admin'], function($routes) {
        $routes->get('/admin/dashboard', 'DashboardController::admin');
        // CRUD Saran
        $routes->get('/admin/kotak-saran', 'KotakSaranController::adminIndex');
        $routes->get('/admin/kotak-saran/create', 'KotakSaranController::create');
        $routes->post('/admin/kotak-saran/store', 'KotakSaranController::store');
        $routes->get('/admin/kotak-saran/(:num)/edit', 'KotakSaranController::edit/$1');
        $routes->post('/admin/kotak-saran/(:num)/update', 'KotakSaranController::update/$1');
        $routes->delete('/admin/kotak-saran/(:num)/delete', 'KotakSaranController::delete/$1');
        
        // Tanggapan
        $routes->get('/admin/kotak-saran/(:num)/tanggapi', 'KotakSaranController::showTanggapanForm/$1');
        $routes->post('/admin/kotak-saran/(:num)/tanggapi', 'KotakSaranController::storeTanggapan/$1');
        $routes->match(['get', 'post'], '/admin/kotak-saran/(:num)/update-status', 'KotakSaranController::updateStatus/$1');
        
        // User Management
        $routes->get('/admin/users', 'UserController::index');
        $routes->get('/admin/users/(:num)', 'UserController::show/$1');
    });
});
