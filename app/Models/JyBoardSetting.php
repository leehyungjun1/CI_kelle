<?php

namespace App\Models;

use CodeIgniter\Model;

class JyBoardSetting extends Model
{
    protected $table            = 'jy_board_settings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['board_id','name','new','total','type','use_yn'];

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
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getBoardList(array $filters = [])
    {
        $this->select("
        id, board_id, name, new, total, reply, use_yn, created_at,
        CASE type
            WHEN 'D' THEN '일반형'
            WHEN 'G' THEN '갤러리형'
            WHEN 'E' THEN '이벤트형'
            WHEN 'Q' THEN '1:1문의형'
            ELSE '알수없음'
        END AS type_name
    ");

        if (!empty($filters['use_yn'])) {
            $this->where('use_yn', $filters['use_yn']);
        }

        if (!empty($filters['keyword']) && !empty($filters['key'])) {
            $column = $filters['key'];
            $keyword = $filters['keyword'];

            if (($filters['searchKind'] ?? '') === 'equalSearch') {
                $this->where($column, $keyword);
            } else {
                $this->like($column, $keyword);
            }
        }

        return $this;
    }




}
