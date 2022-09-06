<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'user';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'email_user',
        'nama_user',
        'password_user',
        'notelp_user',
        'image_user',
        'active_user',
        'noted_user',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_user';
    protected $updatedField  = 'updated_user';
    protected $deletedField  = 'deleted_user';

    // Validation
    protected $validationRules      = [
        'email_user' => 'required|valid_email|is_unique[user.email_user]',
        'nama_user' => 'required',
        'password_user' => 'required',
        'image_user' => 'required',
        'active_user' => 'required',
    ];
    protected $validationMessages   = [
        'kd_pengelola_region_3' => 'required',
        'kd_pengelola_region_2' => 'required',
        'nama_pengelola_region_3' => 'required',
    ];
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
