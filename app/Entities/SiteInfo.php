<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use Config\Services;

class SiteInfo extends Entity
{
    public function __construct(?array $data = null)
    {
        parent::__construct($data);

        if (isset($data['phone'])) {
            $this->attributes['phone'] = $this->setPhone($data['phone']);
        }

        if (isset($data['fax'])) {
            $this->attributes['fax'] = $this->setFax($data['fax']);
        }

        if (isset($data['cs_phone1'])) {
            $this->attributes['cs_phone1'] = $this->setCsPhone1($data['cs_phone1']);
        }

        if (isset($data['cs_phone2'])) {
            $this->attributes['cs_phone2'] = $this->setCsPhone2($data['cs_phone2']);
        }

        if (isset($data['cs_fax'])) {
            $this->attributes['cs_fax'] = $this->setCsFax($data['cs_fax']);
        }

        if(isset($data['email'])) {
            $this->attributes['email'] = $this->setEmail($data['email']);
        }

        if(isset($data['cs_email'])) {
            $this->attributes['cs_email'] = $this->setEmail($data['cs_email']);
        }
    }


    protected function setPhone(string $value)
    {
        $encrypter = \Config\Services::encrypter();
        $plain = preg_replace('/[^0-9]/', '', $value);
        $encrypted = base64_encode($encrypter->encrypt($plain));

        return $encrypted;
    }

    protected function setFax(string $value)
    {

    }

    protected function getPhone()
    {
        return $this->decryptPhoneField('phone');
    }

    protected function getCsPhone1()
    {
        return $this->decryptPhoneField('cs_phone1');
    }

    protected function getCsPhone2()
    {
        return $this->decryptPhoneField('cs_phone2');
    }

    protected function getFax()
    {
        return $this->decryptPhoneField('fax');
    }

    protected function getCsFax()
    {
        return $this->decryptPhoneField('cs_fax');
    }

    /**
     * 이메일 암호화/복호화
     */
    protected function setEmail(string $value)
    {
        return $this->encryptBase64Field($value);
    }

    protected function getEmail()
    {
        return $this->decryptBase64Field('email');
    }

    protected function setCsEmail(string $value)
    {
        log_message('debug', $value);
        return $this->encryptBase64Field($value);
    }

    protected function getCsEmail()
    {
        return $this->decryptBase64Field('cs_email');
    }


    private function encryptBase64Field(string $value, string $type = null): string
    {
        if(empty($value)) {
            return '';
        }

        $encrypter = Services::encrypter();
        if($type == 'phone') {
            $value = preg_replace('/[^0-9]/', '', $value);
        }
        return base64_encode($encrypter->encrypt(trim($value)));
    }

    private function decryptBase64Field(string $value, string $type = null): string
    {
        $encrypter = Services::encrypter();
        $encrypted = $this->attributes[$value] ?? '';

        if (empty($encrypted)) {
            return '';
        }

        try {
            if($type == 'phone') {
               $plain =  $encrypter->decrypt(base64_decode($encrypted));
                return $this->formatPhoneNumber($plain);
            } else {
                return $encrypter->decrypt(base64_decode($encrypted));
            }

        } catch (\Throwable $e) {
            return $encrypted; // 실패 시 원문 그대로 반환
        }
    }

    private function formatPhoneNumber(string $phone): string
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (strlen($phone) === 10) {
            return preg_replace('/^(\d{3})(\d{3})(\d{4})$/', '$1-$2-$3', $phone);
        } elseif (strlen($phone) === 11) {
            return preg_replace('/^(\d{3})(\d{4})(\d{4})$/', '$1-$2-$3', $phone);
        } else if (strlen($phone) === 9) {
            return preg_replace('/^(\d{2})(\d{3})(\d{4})$/', '$1-$2-$3', $phone);
        }

        return $phone;
    }
}