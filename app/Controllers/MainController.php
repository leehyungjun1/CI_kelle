<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class MainController extends BaseController
{
    public function index()
    {
        return view('layout/main', [
            'active'  => 'home',
            'content' => view('pages/home'),
        ]);
    }

    public function main()
    {
        return view('main_new');
    }

    public function editor()
    {
        return view('editor');
    }

    public function home()
    {
        return $this->render('pages/home', [
            'active' => 'home',
        ]);
    }
}

