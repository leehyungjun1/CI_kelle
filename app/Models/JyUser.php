<?php

namespace App\Models;

use CodeIgniter\Model;

class JyUser extends Model
{
    protected $table            = 'jy_users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $beforeInsert = ['setConvertData'];
    protected $beforeUpdate = ['setConvertData'];
    protected $afterFind    = ['getConvertData'];

    protected $encrypter;


    protected $allowedFields = [
        'userid',
        'name',
        'nickname',
        'email',
        'email1',
        'email2',
        'mail_YN',
        'password',
        'grade',
        'member_type',
        'regist_YN',
        'mobile',
        'sms_YN',
        'phone',
        'postcode',
        'address1',
        'address2',
        'regist_kind',
        'loginIP'
    ];

    public function __construct()
    {
        parent::__construct();
        $this->encrypter = \Config\Services::encrypter();
    }

    protected function setConvertData(array $data)
    {
        if (isset($data['id']) && isset($data['data']['userid'])) {
            unset($data['data']['userid']);
        }

        if(!empty($data['data']['email1']) && !empty($data['data']['email2'])){
            $data['data']['email'] = base64_encode($this->encrypter->encrypt($data['data']['email1']."@".$data['data']['email2']));

            unset($data['data']['email1'], $data['data']['email2']);
        }

        if(!empty($data['data']['phone'])){
            $data['data']['phone'] = base64_encode($this->encrypter->encrypt(str_replace("-","",$data['data']['phone'])));
        }

        if(!empty($data['data']['mobile'])){
            $data['data']['mobile'] = base64_encode($this->encrypter->encrypt(str_replace("-","",$data['data']['mobile'])));
        }

        if(!empty($data['data']['address2'])){
            $data['data']['address2'] = base64_encode($this->encrypter->encrypt($data['data']['address2']));
        }

        if (!empty($data['data']['password'])) {
            // 이미 해시가 아니면 해시 처리
            if (!password_get_info($data['data']['password'])['algo']) {
                $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
            }
        }

        return $data;
    }


    protected function processRow(array &$row)
    {
        // 이메일
        if (!empty($row['email'])) {
            $row['email1'] = null;
            $row['email2'] = null;

            try {
                $decoded = $this->encrypter->decrypt(base64_decode($row['email']));
                [$row['email1'], $row['email2']] = explode('@', $decoded);
            } catch (\Exception $e) {
                if (strpos($row['email'], '@') !== false) {
                    [$row['email1'], $row['email2']] = explode('@', $row['email']);
                }
            }
        }

        // 전화번호
        foreach (['mobile','phone'] as $field) {
            if (!empty($row[$field])) {
                try {
                    $row[$field] = $this->encrypter->decrypt(base64_decode($row[$field]));
                    $len = strlen($row[$field]);
                    if ($len === 11) {
                        $row[$field] = preg_replace('/(\d{3})(\d{4})(\d{4})/', '$1-$2-$3', $row[$field]);
                    } elseif ($len === 10) {
                        $row[$field] = preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1-$2-$3', $row[$field]);
                    }
                } catch (\Exception $e) {
                    // 실패 시 원본 유지
                }
            }
        }

        // address2
        if (!empty($row['address2'])) {
            try {
                $row['address2'] = $this->encrypter->decrypt(base64_decode($row['address2']));
            } catch (\Exception $e) {}
        }
    }

    protected function getConvertData(array $data)
    {
        if (!empty($data['data']) && is_array($data['data'])) {
            if (isset($data['singleton']) && $data['singleton'] == 1) {
                $row = &$data['data'];
                $this->processRow($row);
            } else {
                foreach ($data['data'] as &$row) {
                    $this->processRow($row);
                }
            }
        }
        return $data;
    }



}
