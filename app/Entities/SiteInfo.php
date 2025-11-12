<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use Config\Services;

class SiteInfo extends Entity
{
    public function __construct(?array $data = null)
    {
        parent::__construct($data);

        $encryptionField = [
            'phone' => 'phone',
            'fax'   => 'phone',
            'cs_phone1' => 'phone',
            'cs_phone2' => 'phone',
            'cs_fax' => 'phone',
            'email' => null,
            'cs_email' => null,
        ];

        foreach($encryptionField as $field => $type) {
            if(isset($data[$field])) {
                $this->attributes[$field] = $this->encryptBase64Field($data[$field], $type);
            }
        }
    }

    protected function getPhone()
    {
        return $this->decryptBase64Field('phone','phone');
    }
    protected function getFax()
    {
        return $this->decryptBase64Field('fax','phone');
    }
    protected function getCsPhone1()
    {
        return $this->decryptBase64Field('cs_phone1','phone');
    }
    protected function getCsPhone2()
    {
        return $this->decryptBase64Field('cs_phone2','phone');
    }
    protected function getCsFax()
    {
        return $this->decryptBase64Field('cs_fax','phone');
    }
    protected function getEmail()
    {
        return $this->decryptBase64Field('email');
    }
    protected function getCsEmail()
    {
        return $this->decryptBase64Field('cs_email');
    }

    private function encryptBase64Field(string $field, ?string $type = null): string
    {
        if(empty($field)) {
            return '';
        }

        $encrypter = Services::encrypter();
        if($type == 'phone') {
            $field = preg_replace('/[^0-9]/', '', $field);
        }
        return base64_encode($encrypter->encrypt(trim($field)));
    }

    private function decryptBase64Field(string $field, ?string $type = null): string
    {
        $encrypter = Services::encrypter();
        $encrypted = $this->attributes[$field] ?? '';

        if (empty($encrypted)) {
            return '';
        }

        try {
            $plain =  $encrypter->decrypt(base64_decode($encrypted));
            return $type === 'phone' ? $this->formatPhoneNumber($plain) : $plain;
        } catch (\Throwable $e) {
            log_message('error', 'Decrypt failed for ' . $field . ': ' . $e->getMessage());
            return ''; // 실패 시 빈값 발생
        }
    }

    private function formatPhoneNumber(string $phone): string
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (preg_match('/^(02)(\d{3,4})(\d{4})$/', $phone, $m)) {
            return "{$m[1]}-{$m[2]}-{$m[3]}"; // 서울번호
        } elseif (preg_match('/^(\d{3})(\d{3,4})(\d{4})$/', $phone, $m)) {
            return "{$m[1]}-{$m[2]}-{$m[3]}"; // 휴대폰 및 지역번호
        } elseif(preg_match('/^(\d{4})(\d{4})$/',$phone,$m)) {
            return "{$m[1]}-{$m[2]}";
        }
        return $phone;
    }
}