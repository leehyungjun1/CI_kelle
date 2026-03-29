<?php

namespace App\Models;

use CodeIgniter\Model;

class JySetting extends Model
{
    protected $table            = 'jy_settings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['code','code_name'];

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

    public function getCodesByPrefixes(array $prefixes)
    {
        $result = [];
        foreach($prefixes as $prefix) {
            $result[$prefix] = $this->where('use_yn','Y')
                ->like('code',$prefix, 'after')
                ->where('length(code)',9)
                ->findAll();
        }
        return $result;
    }

    public function getCodeName($targetCode) {
        $code_name = $this->select('code_name')
            ->where('use_yn','Y')
            ->where('LENGTH(code)', 9)
            ->where('code', $targetCode)
            ->first();
        return $code_name['code_name'] ?? null;
    }

    public function getCourseCodes() : array
    {
        $all = $this->where('use_yn','Y')
            ->like('code', '103', 'after')
            ->findAll();

        $result = [
            'depth1' => [],
            'depth2' => [],
            'depth3' => [],
        ];

        foreach($all as $row) {
            $len = strlen($row['code']);
            if($len === 3) $result['depth1'][] = $row;
            elseif($len === 6) $result['depth2'][] = $row;
            elseif($len === 9) $result['depth3'][] = $row;
        }

        return $result;
    }
}
