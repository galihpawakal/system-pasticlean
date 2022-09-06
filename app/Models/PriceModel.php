<?php

namespace App\Models;

use CodeIgniter\Model;

class PriceModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'price';
    protected $primaryKey       = 'id_price';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kd_client_region_3',
        'id_atm_kategori',
        'value_price',
        'noted_price',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_price';
    protected $updatedField  = 'updated_price';
    protected $deletedField  = 'deleted_price';

    // Validation
    protected $validationRules      = [
        'value_price' => 'required',
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
