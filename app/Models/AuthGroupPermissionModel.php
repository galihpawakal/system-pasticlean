<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthGroupPermissionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'auth_group_permission';
    protected $primaryKey       = 'id_auth_group_permission';
    protected $foreiginkey      = ['id_auth_group', 'id_auth_permission'];
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_auth_group',
        'id_auth_permission',
        'noted_auth_group_permission',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_auth_group_permission';
    protected $updatedField  = 'updated_auth_group_permission';
    protected $deletedField  = 'deleted_auth_group_permission';

    // Validation
    protected $validationRules      = [
        'id_auth_group' => 'required',
        'id_auth_permission' => 'required',

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
