<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JyBoard;
use App\Models\JyBoardFile;
use App\Models\JyBoardHeader;
use App\Models\JyBoardReplies;
use App\Models\JyBoardSetting;
use App\Services\DynamicBoardService;
use CodeIgniter\HTTP\ResponseInterface;

class BoardController extends BaseController
{
    protected DynamicBoardService $service;

    public function __construct()
    {
        helper('board');
        $this->service = new DynamicBoardService();
    }

    public function board_list() {
        $boardModel = new JyBoardSetting();
        $get        = $this->request->getGet();

        $filters = [
            'key'        => $get['key']        ?? '',
            'searchKind' => $get['searchKind'] ?? '',
            'keyword'    => $get['keyword']    ?? '',
            'use_yn'     => $get['use_yn']     ?? '',
            'type'       => $get['type']       ?? '',
        ];

        $totalCount = $boardModel->countAllResults(false);
        $boardModel->getBoardList($filters)->orderBy('id', 'desc');
        $paging = $this->makePaging($boardModel, $get);

        return $this->render('admin/board/board_list', [
            'gnbActive'  => 'board',
            'sideActive' => 'board_list',
            'sideMenu'   => 'admin/menu/board_menu',
            'breadcrumb' => ['게시판', '게시판 관리', '게시판 리스트'],
            'boards'     => $paging['items'],
            'totalCount' => $totalCount,
            'get'        => $get,
            ...$paging['meta'],
        ]);
    }

    public function board_register($id = null)
    {
        $boardModel = new JyBoardSetting();
        $headerModel = new JyBoardHeader();

        $mode  = $id ? 'edit' : 'create';
        $board = $id ? $boardModel->find($id) : [
            'id'       => '',
            'board_id' => '',
            'name'     => '',
            'use_yn'   => 'Y',
            'type'     => 'D',
        ];

        if ($id && !$board) {
            return redirect()->to('/admin/board/board_list')
                ->with('error', '해당 게시판을 찾을 수 없습니다.');
        }

        $headers = $id ? $headerModel->where('board_setting_id', $id)
            ->orderBy('order_no', 'asc')
            ->findAll()
            : [];

        return $this->render('admin/board/board_register', [
            'gnbActive'  => 'board',
            'sideActive' => 'board_register',
            'sideMenu'   => 'admin/menu/board_menu',
            'breadcrumb' => ['게시판', '게시판 관리', $mode === 'edit' ? '게시판 수정' : '게시판 등록'],
            'board'      => $board,
            'mode'       => $mode,
            'pageTitle'  => $mode === 'edit' ? '게시판 수정' : '게시판 등록',
            'headers'    => $headers,
        ]);
    }

    public function board_delete($article_id = null) {

        $article_id = $this->request->getPost('ids');

        if (empty($article_id)) {
            return $this->response->setJSON([
                'status'    => 'error',
                'message'    => '삭제할 항목이 없습니다.'
            ]);
        }

        $boardModel = new JyBoardSetting();
        $boardModel->delete($article_id);

        return $this->response->setJSON([
            'status'    => 'success',
            'message'   => '삭제되었습니다.'
        ]);
    }

    public function submit()
    {
        $boardModel  = new JyBoardSetting();
        $id          = $this->request->getPost('id');

        $data = [
            'name'        => $this->request->getPost('name'),
            'type'        => $this->request->getPost('type'),
            'use_yn'      => $this->request->getPost('use_yn'),
            'is_category' => $this->request->getPost('is_category') ?? 'N',
        ];

        try {
            if ($id) {
                $board = $boardModel->find($id);
                if (!$board) {
                    return $this->response->setJSON([
                        'status'  => 'error',
                        'message' => '해당 게시판 정보를 찾을 수 없습니다.'
                    ]);
                }
                $boardModel->update($id, $data);
                $message = '게시판 정보가 수정되었습니다.';
            } else {
                $data['board_id'] = $this->request->getPost('board_id');

                $exists = $boardModel->where('board_id', $data['board_id'])->first();
                if ($exists) {
                    return $this->response->setJSON([
                        'status'  => 'error',
                        'message' => '이미 존재하는 게시판 아이디입니다.'
                    ]);
                }

                $boardModel->insert($data);
                $id = $boardModel->getInsertID(); // ← 새로 생성된 ID 가져오기
                $this->createBoardTable($data['board_id']);
                $message = '새 게시판이 등록되었습니다.';
            }

            // 말머리 저장 - ID 확정 후 호출
            $this->saveCategoryHeader($id);

            return $this->response->setJSON([
                'status'  => 'success',
                'url'     => '/admin/board/board_list',
                'message' => $message,
            ]);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => '오류: ' . $e->getMessage()
            ]);
        }
    }

    public function article_list($board_id = null)
    {
        $boardSettingModel = new JyBoardSetting();
        $headerModel       = new JyBoardHeader();

        $boardLists = $boardSettingModel->where('use_yn', 'Y')->orderBy('id', 'desc')->findAll();

        if (empty($board_id)) {
            $board_id = $boardLists[0]['board_id'];
            return redirect()->to('/admin/board/article_list/' . $board_id);
        }

        $get = $this->request->getGet();

        $filters = [
            'board_id'   => $board_id,
            'key'        => $get['key']        ?? '',
            'searchKind' => $get['searchKind'] ?? '',
            'keyword'    => $get['keyword']    ?? '',
            'pageNum'    => $get['pageNum']    ?? 10,
            'dateKind'   => $get['dateKind']   ?? '',
            'page'       => $get['page']       ?? 1,
            'header_id'  => $get['header_id']  ?? '',
        ];

        $entryDt = $get['entryDt'] ?? [];
        if (is_array($entryDt)) {
            $filters['startDate'] = $entryDt[0] ?? null;
            $filters['endDate']   = $entryDt[1] ?? null;
        }

        // ── 말머리 불러오기 추가 ──
        $boardSetting = $boardSettingModel->where('board_id', $board_id)->first();
        $headers = [];
        $headersMap   = [];
        if (!empty($boardSetting) && $boardSetting['is_category'] === 'Y') {
            $headers = $headerModel->where('board_setting_id', $boardSetting['id'])
                ->where('is_use', 'Y')
                ->orderBy('order_no', 'asc')
                ->findAll();

            // id 기준으로 맵핑
            foreach ($headers as $header) {
                $headersMap[$header['id']] = $header;
            }
        }

        $boards = $this->service->articleList($board_id, $filters);

        return $this->render('admin/board/article_list', [
            'headers'      => $headers,
            'headersMap'   => $headersMap,
            'boardSetting' => $boardSetting,
            'gnbActive'  => 'board',
            'sideActive' => 'article_list',
            'sideMenu'   => 'admin/menu/board_menu',
            'breadcrumb' => ['게시판', '게시글 관리'],
            'boardLists' => $boardLists,
            'boards'     => $boards,
            'board_id'   => $board_id,
            'filters'    => $filters,
            'get'        => $get,
        ]);
    }

    public function article_view($board_id = null, $article_id = null)
    {
        if (empty($board_id)) {
            return redirect()->back()->with('error', '잘못된 접근입니다.');
        }

        $board = $this->service->articleView($board_id, $article_id);
        $files = $this->service->getFiles($board_id, $article_id);

        if (!is_array($board) || empty($board)) {
            return redirect()->to('/admin/board/article_list/'.$board_id)
                ->with('error', '해당 게시물이 존재하지 않습니다.');
        }

        return $this->render('admin/board/article_view', [
            'gnbActive'  => 'board',
            'sideActive' => 'article_list',
            'sideMenu'   => 'admin/menu/board_menu',
            'breadcrumb' => ['게시판', '게시글 관리', '게시글 보기'],
            'board'      => $board,
            'files'      => $files,
            'board_id'   => $board_id,
        ]);
    }

    public function article_delete($board_id = null, $article_id = null) {
        if(empty($board_id)) {
            return redirect()->back()->with('error', '잘못된 접근입니다.');
        }
        $article_id = $this->request->getPost('ids');

        if (empty($article_id)) {
            return $this->response->setJSON([
                'status'    => 'error',
                'message'    => '삭제할 항목이 없습니다.'
            ]);
        }

        $board = $this->service->articleDelete($board_id, $article_id);

        return $this->response->setJSON([
            'status'    => 'success',
            'message'   => '삭제되었습니다.'
        ]);
    }

    public function article_register($board_id = null, $id = null)
    {
        $boardSettingModel = new JyBoardSetting();
        $headerModel        = new JyBoardHeader();

        $boardLists = $boardSettingModel->where('use_yn', 'Y')->orderBy('id', 'desc')->findAll();

        if (empty($boardLists)) {
            return redirect()->to('/admin/board/article_list')
                ->with('error', '사용 가능한 게시판 설정이 없습니다.');
        }

        if (!$board_id) {
            $board_id = $boardLists[0]['board_id'];
        }

        $boardSetting = $boardSettingModel->where('board_id', $board_id)->first();
        if (!$boardSetting) {
            return redirect()->to('/admin/board/article_list')
                ->with('error', '해당 게시판 설정을 찾을 수 없습니다.');
        }

        // ── 말머리 불러오기 ──
        $headers = [];
        if (!empty($boardSetting) && ($boardSetting['is_category'] ?? 'N') === 'Y') {
            $headers = $headerModel
                ->where('board_setting_id', $boardSetting['id'])
                ->where('is_use', 'Y')
                ->orderBy('order_no', 'asc')
                ->findAll();
        }

        $mode    = $id ? 'edit' : 'create';
        $files   = [];
        $article = [
            'id'          => '',
            'board_code'  => $board_id,
            'title'       => '',
            'content'     => '',
            'writer'      => '',
            'writer_id'   => '',
            'writer_type' => 'admin',
            'is_notice'   => 'N',
            'is_secret'   => 'N',
            'is_main'     => 'N',
            'is_use'      => 'Y',
            'rating'      => 0,
        ];

        if ($id) {
            $article = $this->service->articleRegister($board_id, $id);
            $files   = $this->service->getFiles($board_id, $id);
            if (!$article) {
                return redirect()->to('/admin/board/article_list/' . $board_id)
                    ->with('error', '해당 게시글을 찾을 수 없습니다.');
            }
        }

        $pageTitle = $mode === 'edit' ? '게시글 수정' : '신규 게시글 등록';

        return $this->render('admin/board/article_register', [
            'gnbActive'  => 'board',
            'sideActive' => 'article_register',
            'sideMenu'   => 'admin/menu/board_menu',
            'breadcrumb' => ['게시판', '게시글 관리', $pageTitle],
            'mode'       => 'article',
            'board_id'   => $board_id,
            'boardLists' => $boardLists,
            'article'    => $article,
            'pageTitle'  => $pageTitle,
            'files'      => $files,
            'headers'      => $headers,
            'boardSetting' => $boardSetting,
        ]);
    }

    public function article_submit() {
        $post = $this->request->getPost();
        $post['mode'] = 'article';
        $uploadFiles = $this->request->getFiles()['upfiles'] ?? [];
        $file_ids = $this->request->getPost('file_ids') ?? [];

        if(isset($post['delFile'])) {
            $jyBoadModel = new JyBoardFile();
            $this->service->deleteFiles($post['delFile']);
            $jyBoadModel->whereIn('id', $post['delFile'])->delete();
        }

        $result = $this->service->articleSave($post);

        $board_code = $post['board_code'] ?? '';
        $article_id = $result['id'];

        if (!empty($uploadFiles)) {
            $this->service->saveFiles($board_code, $article_id, $uploadFiles, $file_ids);
        }

        $this->updateBoardCount($board_code);
        return $this->response->setJSON($result);
    }

    public function reply_register($board_id = null, $article_id=null, $replies_id = null) {

        $board = $this->service->articleView($board_id, $article_id);

        $article = [
            'id' => '',
            'title' => 'RE : '.$board['title']  ,
            'content' => '',
            'writer' => '',
            'writer_id' => '',
            'name' => '',
            'use_yn' => '',
            'type'  => '',
        ];

        if($replies_id) {
            $article = $repliesModel -> find($replies_id);
        }

        $files = new JyBoardFile();

        $files = $files->where('board_id', $board_id)->where('article_id', $article_id)->first() ?? [];


        return view('admin/board/replies_register', [
            'mode'          => 'replies',
            'article'       => $article,
            'board'         => $board,
            'files'         => $files,
            'pageTitle'     => '게시글 답변',
        ]);
    }

    public function replies_submit() {
        $post = $this->request->getPost();
        $post['mode'] = 'reply';
        $post['writer_type'] = 'admin';
        $result = $this->service->articleSave($post);
        return $this->response->setJSON($result);
    }


    function extractImages($content) {
        preg_match_all('/<img[^>]+src="([^">]+)"/', $content, $matches);
        return $matches[1] ?? [];
    }

    function moveImageToBoardFolder($src, $board_id, $board_type = 'editor') {
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

    private function createBoardTable($setting_name)
    {
        $forge = \Config\Database::forge();
        $db    = \Config\Database::connect();

        $tableName = "jy_board_" . $setting_name;

        // 이미 있으면 스킵
        if ($db->tableExists($tableName)) return;

        $fields = [
            'id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
                'comment'        => '고유 ID'
            ],
            'board_id' => [
                'type'          => 'BIGINT',
                'unsigned'       => true,
                'comment'        => '게시판 고유 번호'
            ],
            'group_id' => [
                'type'          => 'BIGINT',
                'unsigned'      => true,
                'null'          => true,
                'comment'       => '원글 그룹 ID'
            ],
            'parent_id' => [
                'type'           => 'TINYINT',
                'unsigned'       => true,
                'comment'        => '상위 게시판 아이디'
            ],
            'depth' => [
                'type'           => 'TINYINT',
                'unsigned'       => true,
                'comment'        => '깊이'
            ],
            'order_no' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'default'        => 0,
                'comment'        => '댓글 순서'
            ],
            'header_id' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
                'null'     => true,
                'default'  => null,
                'comment'  => '카테고리 ID'
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
                'comment'    => '제목'
            ],
            'content' => [
                'type'      => 'TEXT',
                'null'      => true,
                'comment'   => '내용'
            ],
            'rating' => [
                'type'           => 'TINYINT',
                'unsigned'       => true,
                'comment'        => '별점'
            ],
            'writer_type' => [
                'type' => 'ENUM',
                'constraint' => ['admin','user'],
                'default' => 'user'
            ],
            'writer_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'null' => true
            ],
            'writer' => [
                'type'      => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
                'comment'    => '작성자'
            ],            
            'is_notice' => [
                'type' => 'ENUM',
                'constraint' => ['Y','N'],
                'default' => 'N'
            ],
            'is_secret' => [
                'type' => 'ENUM',
                'constraint' => ['Y','N'],
                'default' => 'N'
            ],
            'is_use' => [
                'type' => 'ENUM',
                'constraint' => ['Y','N'],
                'default' => 'N',
                'comment'    => '보여지기 여부'
            ],
            'keywords' => [
                'type'    => 'VARCHAR',
                'constraint' => 200,
                'null'    => true,
                'default' => null,
                'comment' => '키워드'
            ],
            'status' => [
                'type'       => 'SET',
                'constraint' => ['popular', 'recommend', 'new'],
                'null'       => true,
                'default'    => null,
                'comment'    => '상태'
            ],
            'hit'   => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'comment'        => '조회수'
            ],
            'is_main' => [
                'type' => 'ENUM',
                'constraint' => ['Y','N'],
                'default' => 'N',
                'comment'    => '메인 보여지기 여부'
            ],
            'ip' => [
                'type' => 'VARCHAR',
                'constraint' => '16',
                'null' => true,
                'comment' => '아이피'
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ];

        $forge->addField($fields);
        $forge->addKey('id', true);
        $forge->createTable($tableName, true);
    }


    private function saveCategoryHeader($id): void
    {
        $headerModel = new JyBoardHeader();

        $isCategory = $this->request->getPost('is_category') ?? 'N';
        $names      = $this->request->getPost('header_name') ?? [];
        $bgColors   = $this->request->getPost('badge_color') ?? [];
        $textColors = $this->request->getPost('text_color')  ?? [];
        $isUses     = $this->request->getPost('is_use')      ?? [];
        $ids        = $this->request->getPost('category_id') ?? [];

        // is_category 미사용이면 기존 헤더 전부 삭제
        if ($isCategory !== 'Y') {
            $headerModel->where('board_setting_id', $id)->delete();
            return;
        }

        $oldHeaders = $headerModel->where('board_setting_id', $id)->findAll();
        $oldIds     = array_column($oldHeaders, 'id');
        $usedIds    = [];

        foreach ($names as $i => $name) {
            $name = trim($name);
            if ($name === '') continue;

            $headerId = $ids[$i] ?? null;

            $rowData = [
                'board_setting_id' => $id,
                'header_name'      => $name,
                'badge_color'      => $bgColors[$i]   ?? '#ff0000',
                'text_color'       => $textColors[$i] ?? '#ffffff',
                'order_no'         => $i,
                'is_use'           => isset($isUses[$i]) ? 'Y' : 'N',
            ];

            if ($headerId) {
                $headerModel->update($headerId, $rowData);
                $usedIds[] = (int)$headerId;
            } else {
                $newId     = $headerModel->insert($rowData);
                $usedIds[] = (int)$newId;
            }
        }

        // 삭제된 헤더 처리
        $deleteIds = array_diff($oldIds, $usedIds);
        if (!empty($deleteIds)) {
            $headerModel->whereIn('id', $deleteIds)->delete();
        }
    }

    // ── 게시판 카운트 업데이트 메서드 ──
    private function updateBoardCount(string $board_code): void
    {
        $boardSettingModel = new JyBoardSetting();
        $boardSetting      = $boardSettingModel->where('board_id', $board_code)->first();

        if (!$boardSetting) return;

        $dynamicModel = new \App\Models\DynamicBoardModel();
        $dynamicModel->setTableName('jy_board_' . $board_code);

        // 전체 글 수
        $total = $dynamicModel->where('deleted_at', null)->countAllResults();

        // 신규 글 수 (오늘 날짜 기준)
        $new = $dynamicModel
            ->where('deleted_at', null)
            ->where('DATE(created_at)', date('Y-m-d'))
            ->countAllResults();

        $boardSettingModel->update($boardSetting['id'], [
            'total' => $total,
            'new'   => $new,
        ]);
    }
}
