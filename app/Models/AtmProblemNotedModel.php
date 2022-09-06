<?php

namespace App\Models;

use CodeIgniter\Model;

class AtmProblemNotedModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'atm_problem_noted';
    protected $primaryKey       = 'id_atm_problem_noted';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_atm_problem',
        'id_user',
        'noted_atm_problem_noted'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_atm_problem_noted';
    protected $updatedField  = 'updated_atm_problem_noted';
    protected $deletedField  = 'deleted_atm_problem_noted';

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
