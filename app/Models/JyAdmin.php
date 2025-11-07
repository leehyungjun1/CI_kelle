<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;


class JyAdmin extends Model
{
    protected $table            = 'jy_admins';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['admin_id','password','email','name','regist_YN', 'department_code','position_code','duty_code','phone','created_at','updated_at','deleted_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
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
    protected $beforeInsert   = ['encryptPhone'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['encryptPhone'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = ['decryptPhone'];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    
    protected function encryptPhone(array $data)
    {
        $encrypter = Services::encrypter();

        if(!empty($data['data']['phone'])) {
            $plain = preg_replace('/[^0-9]/', '', $data['data']['phone']);
            $data['data']['phone'] = base64_encode($encrypter->encrypt($plain));
        }

        return $data;
    }

    protected function decryptPhone(array $data)
    {
        $encrypter = \Config\Services::encrypter();

        // findAll(), find() 둘 다 $data['data'] 키에 담겨서 들어옴
        if (isset($data['data'])) {
            if (is_array($data['data']) && array_is_list($data['data'])) {
                foreach ($data['data'] as &$row) {
                    if (is_array($row)) {
                        $row['phone'] = $this->decodePhoneFormatted($row['phone'] ?? '', $encrypter);
                    }
                }
                unset($row);
            } elseif (is_array($data['data'])) {
                $data['data']['phone'] = $this->decodePhoneFormatted($data['data']['phone'] ?? '', $encrypter);
            }
        }

        return $data;
    }

    private function decodePhoneFormatted(?string $encrypted, $encrypter): string
    {
        if (empty($encrypted)) {
            return '';
        }

        try {
            $plain = $encrypter->decrypt(base64_decode($encrypted));

            // 복호화된 평문을 "010-1234-5678" 형태로 포맷팅
            return $this->formatPhoneNumber($plain);
        } catch (\Throwable $e) {
            // 복호화 실패 시 원본 그대로 반환
            return $encrypted;
        }
    }


    private function formatPhoneNumber(string $phone): string
    {
        // 숫자만 남김
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (strlen($phone) === 10) {
            // 02-xxxx-xxxx or 0xx-xxx-xxxx
            return preg_replace('/^(\d{3})(\d{3})(\d{4})$/', '$1-$2-$3', $phone);
        } elseif (strlen($phone) === 11) {
            // 010-xxxx-xxxx
            return preg_replace('/^(\d{3})(\d{4})(\d{4})$/', '$1-$2-$3', $phone);
        } else {
            return $phone; // 예외: 그대로 출력
        }
    }

    public function getAdminsList(array $filters = [])
    {

        $this->select([
            'id', 'admin_id', 'name', 'department_code',
            'position_code', 'duty_code', 'phone', 'created_at'
        ]);

        if (!empty($filters['regist_YN'])) {
            $this->where('regist_YN', $filters['regist_YN']);
        }
        if (!empty($filters['department_code'])) {
            $this->where('department_code', $filters['department_code']);
        }
        if (!empty($filters['position_code'])) {
            $this->where('position_code', $filters['position_code']);
        }
        if (!empty($filters['duty_code'])) {
            $this->where('duty_code', $filters['duty_code']);
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
