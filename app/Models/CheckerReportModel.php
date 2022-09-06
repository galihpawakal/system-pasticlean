<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckerReportModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'checker_report';
    protected $primaryKey       = 'id_checker_report';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_atm_checker',
        'id_atm_lokasi',
        'id_user',
        'petugas_checker_report',
        'tgl_checker_report',
        'status_checker_report',
        'noted_checker_report',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_checker_report';
    protected $updatedField  = 'updated_checker_report';
    protected $deletedField  = 'deleted_checker_report';

    // Validation
    protected $validationRules      = [
        'petugas_checker_report' => 'required',
        'tgl_checker_report' => 'required',
        'status_checker_report' => 'required'
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
