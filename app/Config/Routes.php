<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
$routes->group('test', function ($routes) {
    $routes->get('/', 'MainController::home');
});


$routes->get('/', 'MainController::main');
$routes->get("/main", 'MainController::main');
$routes->get("editor/upload", 'EditorController::upload');
$routes->post('editor/upload_process_json', 'EditorController::upload_process_json');

$routes->get('admin', function() { return redirect()->to('/admin/login'); });
$routes->get('admin/', function() { return redirect()->to('/admin/login'); });

$routes->get('admin/login', 'Admin\AdminController::login');
$routes->get('admin/logout', 'Admin\AdminController::logout');
$routes->post('admin/login', 'Admin\AdminController::login');


$routes->group('admin', ['filter' => 'adminAuth'], function ($routes) {
    $routes->get('/', 'Admin\AdminController::index');
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

    $routes->group('board', function($routes) {
        $routes->get('board_list', 'Admin\BoardController::board_list');
        $routes->get('board_register', 'Admin\BoardController::board_register');
        $routes->get('board_register/(:num)', 'Admin\BoardController::board_register/$1');
        $routes->post('board_delete', 'Admin\BoardController::board_delete');
        $routes->post('board_delete/(:num)', 'Admin\BoardController::board_delete/$1');
        $routes->post('submit', 'Admin\BoardController::submit');
        $routes->get('article_list', 'Admin\BoardController::article_list');
        $routes->get('article_list/(:segment)', 'Admin\BoardController::article_list/$1');
        $routes->get('article_view/(:segment)/(:num)', 'Admin\BoardController::article_view/$1/$2');
        $routes->get('article_register', 'Admin\BoardController::article_register');
        $routes->get('article_register/(:segment)', 'Admin\BoardController::article_register/$1');
        $routes->get('article_register/(:segment)/(:num)', 'Admin\BoardController::article_register/$1/$2');
        $routes->post('article_delete/(:segment)', 'Admin\BoardController::article_delete/$1');
        $routes->post('article_delete/(:segment)/(:num)', 'Admin\BoardController::article_delete/$1/$2');
        $routes->post('article_submit', 'Admin\BoardController::article_submit');
        $routes->get('replies_register/(:segment)/(:num)', 'Admin\BoardController::reply_register/$1/$2');
        $routes->get('replies_register/(:segment)/(:num)/(:num)', 'Admin\BoardController::reply_register/$1/$2/$3');
        $routes->post('replies_submit', 'Admin\BoardController::replies_submit');
    });
});
