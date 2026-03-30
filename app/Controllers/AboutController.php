<?php

namespace App\Controllers;

use App\Models\DynamicBoardModel;

class AboutController extends BaseController
{
    public function index()
    {
        // review 게시판에서 is_notice='Y' 최근 3개
        $reviewModel = new DynamicBoardModel();
        $reviewModel->setTableName('jy_board_review');

        $reviews = $reviewModel
            ->where('is_notice', 'Y')
            ->where('is_use', 'Y')
            ->where('deleted_at', null)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->findAll();

        return $this->render('pages/about', [
            'reviews' => $reviews,
            'active' => 'about',
        ]);
    }
}