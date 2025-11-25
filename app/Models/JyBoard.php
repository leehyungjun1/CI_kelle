<?php

namespace App\Models;

use CodeIgniter\Model;

class JyBoard extends Model
{
    protected $table            = 'jy_boards';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['title','board_id','content','writer','writer_id','hit','is_notice','secret','use_yn', 'ip', 'main_display'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = ['updateBoardSettingCount'];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = ['attachWriterInfo'];
    protected $beforeDelete   = [];
    protected $afterDelete    = ['deleteBoardSettingCount'];

    public function getBoardList(array $filters = [])
    {
        $this->select("id, board_id, title, writer, writer_id, content, created_at");

        if(isset($filters['board_id'])) {
            $this->where('board_id', $filters['board_id']);
        }

        // 날짜 필터
        $column     = $filters['dateKind'] ?? null;
        $startDate  = $filters['startDate'] ?? null;
        $endDate    = $filters['endDate'] ?? null;

        if ($column) {
            if ($startDate && $endDate) {
                $this->where("$column >=", $startDate . " 00:00:00");
                $this->where("$column <=", $endDate   . " 23:59:59");
            }
            else if ($startDate) {
                $this->where("$column >=", $startDate . " 00:00:00");
            }
            else if ($endDate) {
                $this->where("$column <=", $endDate   . " 23:59:59");
            }
        }

        // 검색
        if (!empty($filters['keyword']) && !empty($filters['key'])) {
            $column = $filters['key'];
            $keyword = $filters['keyword'];

            if (($filters['searchKind'] ?? '') === 'equalSearch') {
                $this->where($column, $keyword);
            } else {
                $this->like($column, $keyword);
            }
        }

        return $this; // Model 그대로 반환
    }

    /* 게시판 정보 가져오기 */
    public function getBoardView($id)
    {
        return $this->select('jy_boards.*, s.name as board_name, a.name as admin_name, a.admin_id as admin_id, u.name as user_name, u.userid as user_id')
            ->join('jy_board_settings s', 'jy_boards.board_id = s.board_id', 'left')
            ->join('jy_admins a', 'jy_boards.writer_id = a.id and jy_boards.writer = "admin"', 'left')
            ->join('jy_users u', 'jy_boards.writer_id = u.id and jy_boards.writer = "user"', 'left')
            ->where('jy_boards.id', $id)
            ->first();
    }

    protected function updateBoardSettingCount(array $data)
    {
        $boardId = $data['data']['board_id'];

        $db = \Config\Database::connect();
        $db->table('jy_board_settings')
            ->set('total', 'total+1', FALSE)
            ->where('board_id', $boardId)->update();
        return $data;
    }

    protected function deleteBoardSettingCount(array $data)
    {
        $ids = $data['id'] ?? [];
        if(empty($ids)) return;

        $db = \Config\Database::connect();

        $builder = $db->table('jy_boards')->select('board_id')->whereIn('id',$ids);
        $rows = $builder->get()->getResultArray();

        if(!$rows) return;

        foreach ($rows as $row) {
            $boardId = $row['board_id'];

            // board_settings 카운트 업데이트
            $db->table('jy_board_settings')
                ->set('total', 'total - 1', false)
                ->where('board_id', $boardId)
                ->update();
        }
    }

    protected function attachWriterInfo(array $data)
    {
        if (!isset($data['data'])) {
            return $data;
        }

        // 여러 개일 경우
        if (is_array($data['data'])) {
            foreach ($data['data'] as &$row) {
                $row = $this->addWriterInfo($row);
            }
        } else {
            // 단일 데이터
            $data['data'] = $this->addWriterInfo($data['data']);
        }

        return $data;
    }

    private function addWriterInfo($row)
    {
        if (!isset($row['writer'], $row['writer_id'])) {
            return $row;
        }

        if ($row['writer'] === 'admin') {
            $model = new \App\Models\JyAdmin();
            $info = $model->find($row['writer_id']);

            $row['writer_name'] = $info['name'] ?? '관리자';
            $row['writer_uid']  = $info['admin_id'] ?? null;

        } else {
            $model = new \App\Models\JyUser();
            $info = $model->find($row['writer_id']);

            $row['writer_name'] = $info['name'] ?? '회원';
            $row['writer_uid']  = $info['userid'] ?? null;
        }

        return $row;
    }
}
