<?php

namespace App\Models;

use CodeIgniter\Model;

class UserPengelolaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'user_pengelola';
    protected $primaryKey       = 'id_user_pengelola';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_auth_group',
        'kd_pengelola_region_3',
        'noted_user_pengelola',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_user_pengelola';
    protected $updatedField  = 'updated_user_pengelola';
    protected $deletedField  = 'deleted_user_pengelola';

    // Validation
    protected $validationRules      = [
        'id_auth_group' => 'required',
        'kd_pengelola_region_3' => 'required',
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
