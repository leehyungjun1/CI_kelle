<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DynamicBoardModel;
use App\Models\JyBoardSetting;
use App\Models\JyBoardHeader;
use App\Models\JyBoardFile;

class ReviewController extends BaseController
{
    protected string $boardCode = 'review';


    // ── 후기 상세 ──
    public function detail($id = null)
    {
        if (!$id) return redirect()->to('/review');

        $dynamicModel      = new DynamicBoardModel();
        $headerModel       = new JyBoardHeader();
        $fileModel         = new JyBoardFile();
        $boardSettingModel = new JyBoardSetting();

        $review = $dynamicModel
            ->setTableName('jy_board_' . $this->boardCode)
            ->where('is_use', 'Y')
            ->where('deleted_at', null)
            ->find($id);

        if (!$review) {
            return redirect()->to('/review');
        }

        // 조회수 증가
        $dynamicModel->update($id, ['hit' => ($review['hit'] ?? 0) + 1]);

        // 파일 목록
        $files = $fileModel
            ->where('article_id', $id)
            ->where('board_id', $this->boardCode)
            ->findAll();

        // 말머리
        $header = null;
        if (!empty($review['header_id'])) {
            $header = $headerModel->find($review['header_id']);
        }

        return view('pages/review_detail', [
            'pagePath' => 'pages/review_detail',
            'active'   => 'review',
            'review'   => $review,
            'files'    => $files,
            'header'   => $header,
        ]);
    }

    // ── 후기 목록 ──
    public function index()
    {
        $dynamicModel      = new DynamicBoardModel();
        $boardSettingModel = new JyBoardSetting();
        $headerModel       = new JyBoardHeader();
        $fileModel         = new JyBoardFile();

        // 게시판 설정
        $boardSetting = $boardSettingModel->where('board_id', $this->boardCode)->first();
        if (!$boardSetting) {
            return redirect()->to('/');
        }

        $get       = $this->request->getGet();
        $page      = (int)($get['page'] ?? 1);
        $perPage   = 10;
        $headerId  = $get['header_id'] ?? '';
        $keyword   = $get['keyword']   ?? '';

        // ── 말머리 목록 ──
        $headers = $headerModel
            ->where('board_setting_id', $boardSetting['id'])
            ->where('is_use', 'Y')
            ->orderBy('order_no', 'ASC')
            ->findAll();

        // ── 이달의 우수 후기 (is_notice = Y) ──
        $featured = $dynamicModel
            ->setTableName('jy_board_' . $this->boardCode)
            ->where('is_use', 'Y')
            ->where('is_notice', 'Y')
            ->where('deleted_at', null)
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->findAll();

        // 우수 후기 파일 맵핑
        $featured = $this->attachFiles($featured, $fileModel);

        // ── 일반 후기 목록 ──
        $model = new DynamicBoardModel();
        $model->setTableName('jy_board_' . $this->boardCode)
            ->where('is_use', 'Y')
            ->where('deleted_at', null);

        if (!empty($headerId)) {
            $model->where('header_id', $headerId);
        }
        if (!empty($keyword)) {
            $model->like('title', $keyword);
        }

        $totalCount = $model->countAllResults(false);

        $reviews = $model
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage, 'default', $page);

        // 일반 후기 파일 맵핑
        $reviews = $this->attachFiles($reviews ?? [], $fileModel);

        // 헤더 맵핑
        $headersMap = [];
        foreach ($headers as $header) {
            $headersMap[$header['id']] = $header;
        }

        return view('pages/review', [
            'pagePath'     => 'pages/review',
            'active'       => 'review',
            'boardSetting' => $boardSetting,
            'headers'      => $headers,
            'headersMap'   => $headersMap,
            'featured'     => $featured,
            'reviews'      => $reviews ?? [],
            'totalCount'   => $totalCount,
            'page'         => $page,
            'perPage'      => $perPage,
            'totalPage'    => ceil($totalCount / $perPage),
            'headerId'     => $headerId,
            'keyword'      => $keyword,
        ]);
    }

    // ── 더보기 AJAX ──
    public function loadMore()
    {
        $dynamicModel = new DynamicBoardModel();
        $fileModel    = new JyBoardFile();

        $get      = $this->request->getGet();
        $page     = (int)($get['page'] ?? 2);
        $perPage  = 10;
        $headerId = $get['header_id'] ?? '';
        $keyword  = $get['keyword']   ?? '';

        $model = $dynamicModel
            ->setTableName('jy_board_' . $this->boardCode)
            ->where('is_use', 'Y')
            ->where('deleted_at', null);

        if (!empty($headerId)) {
            $model->where('header_id', $headerId);
        }
        if (!empty($keyword)) {
            $model->like('title', $keyword);
        }

        $reviews = $model
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage, 'default', $page);

        $reviews    = $this->attachFiles($reviews ?? [], $fileModel);
        $totalCount = $model->countAllResults(false);

        return $this->response->setJSON([
            'status'     => 'success',
            'reviews'    => $reviews,
            'totalCount' => $totalCount,
            'page'       => $page,
            'hasMore'    => ($page * $perPage) < $totalCount,
        ]);
    }

    // ── 파일 맵핑 헬퍼 ──
    private function attachFiles(array $items, JyBoardFile $fileModel): array
    {
        if (empty($items)) return [];

        $ids      = array_column($items, 'id');
        $files    = $fileModel->whereIn('article_id', $ids)
            ->where('board_id', $this->boardCode)
            ->findAll();

        $filesMap = [];
        foreach ($files as $file) {
            $filesMap[$file['article_id']][] = $file;
        }

        foreach ($items as &$item) {
            $item['files'] = $filesMap[$item['id']] ?? [];
            $item['thumb'] = null;
            foreach ($item['files'] as $file) {
                if (preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $file['file_name'])) {
                    $item['thumb'] = $file['file_path'];
                    break;
                }
            }
        }
        unset($item);

        return $items;
    }
}