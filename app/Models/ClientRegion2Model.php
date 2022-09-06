<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientRegion2Model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'client_region_2';
    protected $primaryKey       = 'kd_client_region_2';
    protected $Foreignkey       = 'kd_client_1';
    protected $useAutoIncrement = false;
    // protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kd_client_region_2',
        'kd_client_region_1',
        'nama_client_region_2',
        'telegram_client_region_2',
        'noted_client_region_2',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_client_region_2';
    protected $updatedField  = 'updated_client_region_2';
    protected $deletedField  = 'deleted_client_region_2';

    // Validation
    protected $validationRules      = [
        'kd_client_region_2' => 'required|is_unique[client_region_2.kd_client_region_2]',
        'kd_client_region_1' => 'required',
        'nama_client_region_2' => 'required',
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
