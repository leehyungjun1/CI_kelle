<?php

namespace App\Models;

use CodeIgniter\Model;

class DynamicBoardModel extends Model
{
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'board_id',
        'parent_id',
        'group_id',
        'depth',
        'order_no',
        'title',
        'content',
        'rating',
        'writer_type',
        'writer_id',
        'writer',
        'is_notice',
        'is_secret',
        'is_use',
        'status',
        'hit',
        'is_main',
        'ip',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function setTableName(string $tableName)
    {
        $this->table = $tableName;
        return $this;
    }

}