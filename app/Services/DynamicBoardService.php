<?php

namespace App\Services;

use CodeIgniter\Database\BaseConnection;

class DynamicBoardService
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function list(string $boardCode, array $filters = [])
    {
        $pager = \Config\Services::pager();
        $table = "jy_board_" . $boardCode;

        $page    = isset($filters['page']) ? (int)$filters['page'] : 1;
        $perPage = isset($filters['perPage']) ? (int)$filters['perPage'] : 10;
        $offset  = ($page - 1) * $perPage;

        $keyword  = $filters['keyword']  ?? null;
        $searchIn = $filters['searchIn'] ?? 'title';
        $dateKind = $filters['dateKind'] ?? 'created_at';

        $startDate = $filters['startDate'] ?? null;
        $endDate   = $filters['endDate']   ?? null;

        $totalCount = $this->db->table($table)->countAllResults();

        $builder = $this->db->table($table);

        // 일반 검색
        if (!empty($keyword)) {
            $builder->like($searchIn, $keyword);
        }

        // 날짜 검색
        if (!empty($startDate)) {
            $builder->where("$dateKind >=", $startDate . ' 00:00:00');
        }

        if (!empty($endDate)) {
            $builder->where("$dateKind <=", $endDate . ' 23:59:59');
        }

        $totalSearch = $builder->countAllResults(false);

        $boardData = $builder
            ->orderBy(
                "CASE WHEN parent_id IS NULL THEN id ELSE parent_id END DESC, depth ASC, id DESC",
                '',
                false
            )
            ->limit($perPage, $offset)
            ->get()
            ->getResultArray();



        return [
            'board_id'      => $boardCode,
            'boardData'     => $boardData,
            'totalCount'    => $totalCount,
            'totalSearch'   => $totalSearch,
            'page'          => $page,
            'perPage'       => $perPage,
            'totalPage'     => ceil($totalSearch / $perPage),
            'pager'         => $pager->makeLinks($page, $perPage, $totalSearch)
        ];
    }

    public function insert(string $boardCode, array $data)
    {
        $table = "jy_board_" . $boardCode;
        return $this->db->table($table)->insert($data);
    }
}