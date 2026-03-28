<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class IntroduceController extends BaseController
{
    public function index()
    {
        return view('pages/introduce');
    }
}
