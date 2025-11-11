<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\SiteInfo;
use Config\Services;

class JySiteInfo extends Model
{
    protected $table            = 'jy_site_info';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = SiteInfo::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = ['site_name', 'site_name_en', 'top_title', 'favicon_path', 'company_name', 'business_number', 'ceo_name', 'business_number', 'business_type', 'business_item', 'email', 'zipcode', 'address', 'address_detail', 'phone', 'fax', 'cs_phone1', 'cs_phone2', 'cs_fax', 'cs_email', 'business_hours'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = false;

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
}
