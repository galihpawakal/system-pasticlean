<?php

namespace App\Models;

use CodeIgniter\Model;

class ChecklistCheckerModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'checklist_checker';
    protected $primaryKey       = 'id_checklist_checker';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_atm_checker',
        'nama_checklist_checker',
        'status_foto_checklist_checker',
        'noted_checklist_checker',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_checklist_checker';
    protected $updatedField  = 'updated_checklist_checker';
    protected $deletedField  = 'deleted_checklist_checker';

    // Validation
    protected $validationRules      = [

        'id_atm_checker' => 'required',
        'nama_checklist_checker' => 'required',
        'status_foto_checklist_checker' => 'required'
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
