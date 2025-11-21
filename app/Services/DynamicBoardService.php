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

    private function getArticle(string $board_id, int $article_id)
    {

        $this->setBoard($board_id);
        $table = $this->model->getTable();

        return $this->model
            ->select("{$table}.*, s.name as board_name, s.board_id as board_code")
            ->join('jy_board_settings s', "{$table}.board_id = s.id")
            ->find($article_id);
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

        $page       = isset($filters['page']) ? (int)$filters['page'] : 1;
        $perPage    = isset($filters['perPage']) ? (int)$filters['perPage'] : 10;
        $offset     = ($page - 1) * $perPage;

        $keyword    = $filters['keyword']  ?? null;
        $key        = $filters['key'] ?? 'title';
        $searchKind = $filters['searchKind'] ?? 'equalSearch';
        $dateKind   = $filters['dateKind'] ?? 'created_at';
        $startDate  = $filters['startDate'] ?? null;
        $endDate    = $filters['endDate']   ?? null;

        $totalCount = $this->model->countAll();

        // 일반 검색
        if (! empty($keyword) && ! empty($key)) {
            if($searchKind == 'equalSearch') {
                $this->model->where($key, $keyword);
            } else if($searchKind == 'fullLikeSearch') {
                $this->model->like($key, $keyword);
            }
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
            ->orderBy('group_id', 'DESC')
            ->orderBy('order_no', 'ASC')
            ->orderBy('id', 'ASC')
            ->paginate($perPage, 'default', $page);
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
        return $this->getArticle($board_id, $article_id);
    }

    public function articleView(string $board_id, int $article_id) {
        return $this->getArticle($board_id, $article_id);
    }
    public function articleSave(array $post)
    {
        $board_code = $post['board_code'];
        $this->setBoard($board_code);
        /* 추후 게시판 이름 바꿔서 넣는거 방지 추가 예정 */

        $content = $this->processContentImages($post['content'], $board_code);

        $boardSettingModel = new JyBoardSetting();
        $boardSetting = $boardSettingModel->where('board_id', $board_code)->first();

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

        if($post['mode'] == 'reply') {
            $orginData = $this->model->find($post['board_id']);

            $order_no = $this->findOrderNo($board_code, $post['board_id']);
            $data['parent_id']  = $post['board_id'];
            $data['group_id']   = $orginData['group_id'] ?: $orginData['id'];
            $data['depth']      = $orginData['depth'] + 1;
            $data['order_no']   = $order_no;
        }

        if($post['writer_type'] === 'admin') {
            $admin = session()->get('admin');
            $data['writer_id']  = $admin['admin_id'];
            $data['writer']     = $admin['name'];
        }

        $id = $post['id'] ?? null;
        if ($id) {
            $this->model->update($id, $data);
            return ['status' => 'success', 'message' => '수정 완료!', 'url' => '/admin/board/article_list/'.$board_code];
        }
        $this->model->insert($data);
        $newId = $this->model->getInsertID();
        if ($post['mode'] !== 'reply') {
            $this->model->update($newId, ['group_id' => $newId]);
        }
        return ['status' => 'success', 'message' => '등록 완료!', 'url' => '/admin/board/article_list/'.$board_code];
    }

    public function findOrderNo(string $board_code, int $board_id) {
        $this->setBoard($board_code);
        $row = $this->model->where('parent_id', $board_id)->orderBy('order_no', 'DESC')->first();

        if($row) {
            $order_no = $row['order_no'] ?? 0;
            $group_id = $row['group_id'];
        } else {
            $row = $this->model->find($board_id);
            $order_no = $row['order_no'] ?? 0;
            $group_id = $row['group_id'];
        }

        $this->model
            ->where('group_id', $group_id)
            ->where('order_no >', $order_no)
            ->set('order_no', 'order_no + 1', false)
            ->update();

        return $order_no + 1;
    }



    /* 댓글 넣는 방식 고민 중 */
    public function insertReply(string $board_code, array $post)
    {
        $this->setBoard($board_code);

        $parentId = (int)$post['parent_id'];
        $parent   = $this->model->find($parentId);

        if (!$parent) {
            return ['status' => 'error', 'message' => '부모 글을 찾을 수 없습니다.'];
        }

        $groupId = $parent['group_id'] ?: $parent['id'];

        // 1️⃣ 부모와 같은 group ID 내에서, 부모 바로 아래 들어갈 위치 계산
        $maxOrder = $this->model
            ->where('group_id', $groupId)
            ->where('parent_id', $parent['id'])
            ->selectMax('order_no')
            ->first();

        $insertOrder = ($maxOrder['order_no'] ?? 0) + 1;

        // 2️⃣ 주문번호 밀어주기 (같거나 큰 order_no는 전부 +1)
        $this->model
            ->where('group_id', $groupId)
            ->where('order_no >=', $insertOrder)
            ->set('order_no', 'order_no + 1', false)
            ->update();

        // 3️⃣ 새 댓글 데이터
        $data = [
            'board_id'  => $parent['board_id'],
            'group_id'  => $groupId,
            'parent_id' => $parent['id'],
            'depth'     => $parent['depth'] + 1,
            'order_no'  => $insertOrder,
            'title'     => $post['title'],
            'content'   => $post['content'],
            'writer_type' => $post['writer_type'],
            'writer_id'   => $post['writer_id'] ?? null,
            'writer'      => $post['writer'] ?? null,
            'ip'          => $_SERVER['REMOTE_ADDR'],
        ];

        $this->model->insert($data);

        return ['status' => 'success', 'message' => '댓글 저장 완료'];
    }




    public function repliesRegister(string $board_id, int $article_id , int $replies_id) {
        $this->setBoard($board_code);
    }
}