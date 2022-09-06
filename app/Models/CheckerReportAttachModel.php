<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckerReportAttachModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'checker_report_attach';
    protected $primaryKey       = 'id_checker_report_attach';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_checker_report',
        'id_user',
        'file_checker_report_attach',
        'noted_checker_report_attach',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_checker_report_attach';
    protected $updatedField  = 'updated_checker_report_attach';
    protected $deletedField  = 'deleted_checker_report_attach';

    // Validation
    protected $validationRules      = [

        'file_checker_report_attach' => 'required',
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
