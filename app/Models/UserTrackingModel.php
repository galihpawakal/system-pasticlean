<?php

namespace App\Models;

use CodeIgniter\Model;

class UserTrackingModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'user_tracking';
    protected $primaryKey       = 'id_user_tracking';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_user',
        'link_user_tracking',
        'noted_user_tracking',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_user_tracking';
    protected $updatedField  = 'updated_user_tracking';
    protected $deletedField  = 'deleted_user_tracking';

    // Validation
    protected $validationRules      = [
        'id_user' => 'required',
        'link_user_tracking' => 'required',
    ];
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
