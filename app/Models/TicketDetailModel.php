<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketDetailModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ticket_detail';
    protected $primaryKey       = 'id_ticket_detail';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_ticket',
        'id_user',
        'jenis_ticket_detail',
        'noted_ticket_detail',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_ticket_detail';
    protected $updatedField  = 'updated_ticket_detail';
    protected $deletedField  = 'deleted_ticket_detail';

    // Validation
    protected $validationRules      = [
        'jenis_ticket_detail' => 'required',
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
