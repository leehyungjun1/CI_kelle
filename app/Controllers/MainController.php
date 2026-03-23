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
        $boardSettingModel = new \App\Models\JyBoardSetting();
        $headerModel       = new \App\Models\JyBoardHeader();

        // ── 알림 말머리 맵핑 ──
        $noticeHeadersMap = $this->getBoardHeadersMap('notice');

        // ── 학습자 후기 말머리 맵핑 ──
        $reviewHeadersMap = $this->getBoardHeadersMap('review');

        // ── 알림 게시판 ──
        $notices = (new \App\Models\DynamicBoardModel())
            ->setTableName('jy_board_notice')
            ->where('is_use', 'Y')
            ->where('deleted_at', null)
            ->where('is_main', 'Y')
            ->orderBy('is_notice', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->findAll();

        // ── 학습자 후기 ──
        $reviews = (new \App\Models\DynamicBoardModel())
            ->setTableName('jy_board_review')
            ->where('is_use', 'Y')
            ->where('deleted_at', null)
            ->where('is_main', 'Y')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->findAll();

        return $this->render('pages/home', [  // ← view() → $this->render()
            'notices'          => $notices,
            'noticeHeadersMap' => $noticeHeadersMap,
            'reviews'          => $reviews,
            'reviewHeadersMap' => $reviewHeadersMap,
            'active'           => 'home',
        ]);
    }
}

