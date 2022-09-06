<?php

namespace App\Models;

use CodeIgniter\Model;

class AtmCheckerModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'atm_checker';
    protected $primaryKey       = 'id_atm_checker';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_atm_ring',
        'nama_atm_checker',
        'noted_atm_checker',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_atm_checker';
    protected $updatedField  = 'updated_atm_checker';
    protected $deletedField  = 'deleted_atm_checker';

    // Validation
    protected $validationRules      = [
        'id_atm_ring' => 'required',
        'nama_atm_checker' => 'required',
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
