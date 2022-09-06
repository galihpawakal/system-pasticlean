<?php

namespace App\Models;

use CodeIgniter\Model;

class AtmProblemAttachModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'atm_problem_attach';
    protected $primaryKey       = 'id_atm_problem_attach';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_atm_problem',
        'id_user',
        'file_atm_problem_attach',
        'noted_atm_problem_attach',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_atm_problem_attach';
    protected $updatedField  = 'updated_atm_problem_attach';
    protected $deletedField  = 'deleted_atm_problem_attach';

    // Validation
    protected $validationRules      = [
        'file_atm_problem_attach' => 'required',
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
