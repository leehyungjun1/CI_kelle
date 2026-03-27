<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DynamicBoardModel;

class MainController extends BaseController
{
    private DynamicBoardModel $boardModel;

    public function __construct()
    {
        $this->boardModel = new DynamicBoardModel();
    }
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
        $notices = DynamicBoardModel::table('jy_board_notice')
            ->where('is_use', 'Y')
            ->where('deleted_at', null)
            ->where('is_main', 'Y')
            ->orderBy('is_notice', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->findAll();

        // ── 학습자 후기 ──
        $reviews =DynamicBoardModel::table('jy_board_review')
            ->select('jy_board_review.*, jy_board_files.file_path, jy_board_files.file_name')
            ->join('jy_board_files', 'jy_board_files.board_id = \'review\'  AND jy_board_files.article_id = jy_board_review.id', 'left')
            ->where('jy_board_review.is_use', 'Y')
            ->where('jy_board_review.deleted_at', null)
            ->where('jy_board_review.is_main', 'Y')
            ->orderBy('jy_board_review.created_at', 'desc')
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

