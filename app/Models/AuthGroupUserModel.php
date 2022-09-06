<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthGroupUserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'auth_group_user';
    protected $primaryKey       = 'id_auth_group_user';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_auth_group',
        'id_user',
        'noted_auth_group_user',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_auth_group_user';
    protected $updatedField  = 'updated_auth_group_user';
    protected $deletedField  = 'deleted_auth_group_user';

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
