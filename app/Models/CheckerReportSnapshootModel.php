<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckerReportSnapshootModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'checker_report_snapshoot';
    protected $primaryKey       = 'id_checker_report_snapshoot';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_checker_report',
        'id_snapshoot_checker',
        'foto_checker_report_snapshoot',
        'noted_checker_report_snapshoot',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_checker_report_snapshoot';
    protected $updatedField  = 'updated_checker_report_snapshoot';
    protected $deletedField  = 'deleted_checker_report_snapshoot';

    // Validation
    protected $validationRules      = [
        'foto_checker_report_snapshoot' => 'required',
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
