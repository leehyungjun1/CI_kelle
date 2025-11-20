<?php

namespace App\Services;

use App\Models\JyBoardSetting;
use CodeIgniter\Database\BaseConnection;
use App\Models\DynamicBoardModel;

class DynamicBoardService
{
    protected DynamicBoardModel $model;

    public function __construct()
    {
        $this->model = new DynamicBoardModel();
    }

    private function setBoard(string $board_id)
    {
        $this->model->setTableName("jy_board_{$board_id}");
    }

    private function extractImages($content) {
        preg_match_all('/<img[^>]+src="([^">]+)"/', $content, $matches);
        return $matches[1] ?? [];
    }

    private function processContentImages(string $content, string $board_id): string
    {
        $images = $this->extractImages($content);

        foreach ($images as $img) {
            if (strpos($img, '/uploads/temp') !== false) {
                $newPath = $this->moveImageToBoardFolder($img, $board_id);
                $content = str_replace($img, $newPath, $content);
            }
        }
        return $content;
    }

    private function moveImageToBoardFolder($src, $board_id, $board_type = 'editor') {
        $year  = date('Y');
        $month = date('m');

        // 절대 경로
        $src = str_replace(base_url(), '', $src);
        $relativePath = ltrim(str_replace('/uploads', '', $src), '/');
        $srcPath = WRITEPATH . $relativePath;

        // 새 경로
        $newDir = WRITEPATH . "uploads/{$board_type}/{$board_id}/{$year}/{$month}/";
        if (!is_dir($newDir)) mkdir($newDir, 0777, true);

        $ext = pathinfo($srcPath, PATHINFO_EXTENSION);
        // 유니크 파일명 생성
        $fileName = uniqid('img_', true) . '.' . $ext;
        $destPath = $newDir . $fileName;

        // 파일 이동
        if (file_exists($srcPath)) {
            rename($srcPath, $destPath);
        }

        // 리턴할 새 URL
        return "/uploads/{$board_type}/{$board_id}/{$year}/{$month}/{$fileName}";
    }


    public function articleList(string $board_id, array $filters = [])
    {
        $this->setBoard($board_id);

        $page    = isset($filters['page']) ? (int)$filters['page'] : 1;
        $perPage = isset($filters['perPage']) ? (int)$filters['perPage'] : 10;
        $offset  = ($page - 1) * $perPage;

        $keyword  = $filters['keyword']  ?? null;
        $searchIn = $filters['searchIn'] ?? 'title';
        $dateKind = $filters['dateKind'] ?? 'created_at';
        $startDate = $filters['startDate'] ?? null;
        $endDate   = $filters['endDate']   ?? null;

        $totalCount = $this->model->countAll();

        // 일반 검색
        if (!empty($keyword)) {
            $this->model->like($searchIn, $keyword);
        }

        // 날짜 검색
        if (!empty($startDate)) {
            $this->model->where("{$dateKind} >=", $startDate . ' 00:00:00');
        }

        if (!empty($endDate)) {
            $this->model->where("{$dateKind} <=", $endDate . ' 23:59:59');
        }

        $totalSearch = $this->model->countAllResults(false);

        $boardData = $this->model
            ->orderBy(
                "CASE WHEN parent_id IS NULL THEN id ELSE parent_id END DESC, depth ASC, id DESC",
                '',
                false
            )
            ->paginate($perPage, 'default', $page);;
        $pager = $this->model->pager;

        return [
            'board_id'      => $board_id,
            'boardData'     => $boardData,
            'totalCount'    => $totalCount,
            'totalSearch'   => $totalSearch,
            'page'          => $page,
            'perPage'       => $perPage,
            'totalPage'     => ceil($totalSearch / $perPage),
            'pager'         => $pager
        ];
    }

    public function articleRegister(string $board_id, int $article_id) {
        $this->setBoard($board_id);
        return $this->model->find($article_id);
    }

    public function articleView(string $board_id, int $article_id) {
        $this->setBoard($board_id);
        return $this->model->find($article_id);
    }


    public function articleSave(array $post)
    {
        $board_id = $post['board_id'];
        $this->setBoard($board_id);

        $content = $this->processContentImages($post['content'], $board_id);

        $boardSettingModel = new JyBoardSetting();
        $boardSetting = $boardSettingModel->where('board_id', $board_id)->first();


        $data = [
            'board_id'      => $boardSetting['id'],
            'parent_id'     => 0,
            'depth'         => 0,
            'title'         => $post['title'],
            'content'       => $content,
            'writer_type'   => $post['writer_type'],
            'writer_id'     => '',
            'writer'        => $post['writer'] ?? null,
            'is_notice'     => $post['is_notice'] ?? 'N',
            'is_secret'     => $post['is_secret'] ?? 'N',
            'is_use'        => $post['is_use'] ?? 'N',
            'status'        => $post['status'] ?? 'N',
            'is_main'       => $post['is_main'] ?? 'N',
            'ip'            => $_SERVER['REMOTE_ADDR'],
        ];

        if($post['writer_type'] === 'admin') {
            $admin = session()->get('admin');
            $data['writer_id']  = $admin['admin_id'];
            $data['writer']     = $admin['name'];
        }

        $id = $post['id'] ?? null;
        if ($id) {
            $this->model->update($id, $data);
            return ['status' => 'success', 'message' => '수정 완료!'];
        }
        $this->model->insert($data);
        return ['status' => 'success', 'message' => '등록 완료!'];
    }
}