<?php

namespace App\Models;

use CodeIgniter\Model;

class JySetting extends Model
{
    protected $table         = 'jy_settings';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'code', 'parent_id', 'depth', 'code_name', 'use_yn', 'order_no',
    ];

    // ── 트리 전체 조회 ───────────────────────────────────────────
    /**
     * 전체 트리를 계층 순서대로 반환
     * 반환: depth1 → depth2 → depth3 순, 같은 레벨은 order_no 순
     */
    public function getTree(): array
    {
        $rows = $this->orderBy('depth', 'asc')
            ->orderBy('parent_id', 'asc')
            ->orderBy('order_no', 'asc')
            ->findAll();

        $map  = [];
        $tree = [];

        // 1단계: id 기준 맵 초기화
        foreach ($rows as $row) {
            $map[$row['id']] = $row;
            $map[$row['id']]['children'] = [];
        }

        // 2단계: parent_id 기준으로 children 연결
        foreach ($map as $id => $row) {
            if (!empty($row['parent_id'])) {
                $map[$row['parent_id']]['children'][] = &$map[$id];
            } else {
                $tree[] = &$map[$id];
            }
        }

        return $tree;
    }

    /**
     * 특정 depth1 코드 하위 트리만 조회
     */
    public function getSubTree(int $rootId): array
    {
        // depth1 id 기준으로 depth2 목록
        $depth2 = $this->where('parent_id', $rootId)
            ->orderBy('order_no', 'asc')
            ->findAll();

        $result = [];
        foreach ($depth2 as $d2) {
            $d2['children'] = $this->where('parent_id', $d2['id'])
                ->orderBy('order_no', 'asc')
                ->findAll();
            $result[] = $d2;
        }

        return $result;
    }

    /**
     * 특정 parent_id 의 직계 자식 목록
     */
    public function getChildren(int $parentId): array
    {
        return $this->where('parent_id', $parentId)
            ->orderBy('order_no', 'asc')
            ->findAll();
    }

    /**
     * depth1 목록만
     */
    public function getRoots(): array
    {
        return $this->where('depth', 1)
            ->orderBy('order_no', 'asc')
            ->findAll();
    }

    // ── 코드 자동 생성 ───────────────────────────────────────────
    /**
     * 다음 코드값 자동 생성
     * depth1: 001~999 (3자리)
     * depth2: 부모코드 + 001~999 (6자리)
     * depth3: 부모코드 + 001~999 (9자리)
     */
    public function generateCode(?int $parentId = null): string
    {
        if ($parentId === null) {
            // depth1 — 기존 depth1 중 최대 code + 1
            $last = $this->where('depth', 1)
                ->orderBy('code', 'desc')
                ->first();
            $next = $last ? ((int)$last['code'] + 1) : 1;
            return str_pad($next, 3, '0', STR_PAD_LEFT);
        }

        $parent = $this->find($parentId);
        if (!$parent) return '';

        $last = $this->where('parent_id', $parentId)
            ->orderBy('code', 'desc')
            ->first();

        if ($last) {
            // 부모코드 제거 후 숫자 부분만 증가
            $suffix = substr($last['code'], strlen($parent['code']));
            $next   = (int)$suffix + 1;
        } else {
            $next = 1;
        }

        return $parent['code'] . str_pad($next, 3, '0', STR_PAD_LEFT);
    }

    // ── 드래그앤드롭 순서 변경 ───────────────────────────────────
    /**
     * 같은 레벨(같은 parent_id) 내에서 order_no 일괄 업데이트
     * $orders = [['id'=>1, 'order_no'=>1], ['id'=>2, 'order_no'=>2], ...]
     */
    public function updateOrder(array $orders): bool
    {
        $db = db_connect();
        $db->transBegin();

        try {
            foreach ($orders as $item) {
                $this->update($item['id'], ['order_no' => $item['order_no']]);
            }
            $db->transCommit();
            return true;
        } catch (\Throwable $e) {
            $db->transRollback();
            log_message('error', '[JySetting] updateOrder: ' . $e->getMessage());
            return false;
        }
    }

    // ── Private ─────────────────────────────────────────────────
    private function buildTree(array $rows): array
    {
        $map    = [];
        $result = [];

        foreach ($rows as $row) {
            $row['children'] = [];
            $map[$row['id']] = $row;
        }

        foreach ($map as $id => $row) {
            if ($row['parent_id']) {
                $map[$row['parent_id']]['children'][] = &$map[$id];
            } else {
                $result[] = &$map[$id];
            }
        }

        return $result;
    }

    public function getCodesByPrefixes(array $prefixes, int $depth = 3): array
    {
        $result = [];

        foreach ($prefixes as $prefix) {
            $result[$prefix] = (clone $this)
                ->where('depth', $depth)
                ->like('code', $prefix, 'after')
                ->where('use_yn', 'Y')
                ->orderBy('order_no', 'asc')
                ->findAll();
        }

        return $result;
    }

    public function getCodeName(string $code): string
    {
        $row = $this->where('code', $code)->first();
        return $row ? $row['code_name'] : '';
    }

    public function getCodesByDepth(int $depth, string $prefix = ''): array
    {
        $query = $this->where('depth', $depth)->where('use_yn', 'Y');

        if ($prefix) {
            $query->like('code', $prefix, 'after');
        }

        return $query->orderBy('order_no', 'asc')->findAll();
    }
}