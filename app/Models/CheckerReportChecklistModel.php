<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckerReportChecklistModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'checker_report_checklist';
    protected $primaryKey       = 'id_checker_report_checklist';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_checker_report',
        'id_checklist_checker',
        'status_checker_report_checklist',
        'foto_checker_report_checklist',
        'noted_checker_report_checklist',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_checker_report_checklist';
    protected $updatedField  = 'updated_checker_report_checklist';
    protected $deletedField  = 'deleted_checker_report_checklist';

    // Validation
    protected $validationRules      = [
        'status_checker_report_checklist' => 'required',
        'foto_checker_report_checklist' => 'required',
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
