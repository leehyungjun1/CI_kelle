<?php

namespace App\Models;

use CodeIgniter\Model;

class JyBanner extends Model
{
    protected $table            = 'jy_banners';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'group_id',
        'title',
        'description',
        'image_path',
        'link_url',
        'order_no',
        'is_use',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // ── 그룹 목록 (group_id별 대표 1건) ──
    public function getGroupList()
    {
        return $this->db->query("
            SELECT
                b.group_id,
                COUNT(*) AS slide_count,
                MIN(b.title) AS first_title,
                MIN(b.created_at) AS created_at,
                SUM(CASE WHEN b.is_use = 'Y' THEN 1 ELSE 0 END) AS use_count
            FROM jy_banners b
            WHERE b.deleted_at IS NULL
            GROUP BY b.group_id
            ORDER BY b.group_id ASC
        ")->getResultArray();
    }

    // ── 그룹별 배너 아이템 목록 ──
    public function getByGroup(int $groupId)
    {
        return $this->where('group_id', $groupId)
            ->orderBy('order_no', 'ASC')
            ->orderBy('id', 'ASC')
            ->findAll();
    }

    // ── 다음 group_id 생성 ──
    public function nextGroupId(): int
    {
        $result = $this->db->query("SELECT MAX(group_id) AS max_id FROM jy_banners")->getRow();
        return (int)($result->max_id ?? 0) + 1;
    }

    // ── 프론트에서 group_id로 사용 중인 배너 가져오기 ──
    public function getActiveByGroup(int $groupId): array
    {
        return $this->where('group_id', $groupId)
            ->where('is_use', 'Y')
            ->orderBy('order_no', 'ASC')
            ->findAll();
    }
}