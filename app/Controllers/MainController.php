<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class MainController extends BaseController
{
    public function index()
    {
        return view('main');
    }

    public function main() {
        return view('main_new');
    }

    public function editor() {
        return view('editor');
    }

}
