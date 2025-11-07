<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');

$routes->get('/', 'MainController::main');
$routes->get("/main", 'MainController::main');

$routes->group('admin', function ($routes) {
    $routes->get('/', 'Admin\AdminController::index');
    $routes->get('login', 'Admin\AdminController::login');
    $routes->post('login', 'Admin\AdminController::login');
    $routes->get('dashboard', 'Admin\AdminController::dashboard');
    $routes->post('submit', 'Admin\AdminController::submit');

    $routes->group('policy',function($routes){
        $routes->get('base_info', 'Admin\PolicyController::base_info');
        $routes->get('base_info/(:num)', 'Admin\PolicyController::base_info/$1');
        $routes->post('base_info', 'Admin\PolicyController::base_info_save', ['as' => 'policy_save']);
        $routes->get('manage', 'Admin\PolicyController::manage');
        $routes->get('manage_register', 'Admin\PolicyController::manage_register');
        $routes->get('manage_register/(:num)', 'Admin\PolicyController::manage_register/$1');
        $routes->post('manage_register', 'Admin\PolicyController::manage_register_save', ['as' => 'manage_save']);
        $routes->post('submit', 'Admin\PolicyController::submit');
        $routes->post('manage_action', 'Admin\PolicyController::manage_action');
    });

    $routes->group('member', function($routes) {
        $routes->get('member_list', 'Admin\MemberController::member_list');
        $routes->get('member_register', 'Admin\MemberController::member_register');
        $routes->get('member_register/(:num)?', 'Admin\MemberController::member_register/$1');
        $routes->post('member_register', 'Admin\MemberController::member_register_save',['as'=>'member_save']);
    });
});
