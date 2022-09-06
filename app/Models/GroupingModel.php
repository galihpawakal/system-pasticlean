<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupingModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'grouping';
    protected $primaryKey       = 'id_grouping';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_user',
        'id_atm_lokasi',
        'noted_grouping',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_grouping';
    protected $updatedField  = 'updated_grouping';
    protected $deletedField  = 'deleted_grouping';

    // Validation
    protected $validationRules      = [
        'id_user' => 'required',
        'id_atm_lokasi' => 'required',
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
