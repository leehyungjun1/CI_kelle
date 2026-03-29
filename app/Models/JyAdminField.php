<?php

namespace App\Models;

use CodeIgniter\Model;

class JyAdminField extends Model
{
    protected $table            = 'jy_admins_field';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'admin_id',
        'code',
        'is_use',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // ── 관리자별 담당 코드 목록 ──
    public function getByAdmin(int $adminId): array
    {
        return $this->where('admin_id', $adminId)
            ->where('is_use', 1)
            ->findAll();
    }

    // ── 관리자별 담당 코드만 추출 ──
    public function getCodesByAdmin(int $adminId): array
    {
        $rows = $this->getByAdmin($adminId);
        return array_column($rows, 'code');
    }

    // ── 관리자 담당 코드 저장 (기존 삭제 후 재등록) ──
    public function saveByAdmin(int $adminId, array $codes): void
    {
        // 기존 삭제
        $this->where('admin_id', $adminId)->delete();

        if (empty($codes)) return;

        $rows = [];
        foreach ($codes as $code) {
            $rows[] = [
                'admin_id'   => $adminId,
                'code'       => $code,
                'is_use'     => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }
        $this->insertBatch($rows);
    }
}