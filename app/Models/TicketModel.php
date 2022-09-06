<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ticket';
    protected $primaryKey       = 'id_ticket';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_atm_lokasi',
        'id_user',
        'pelapor_ticket',
        'foto_ticket',
        '',
        'noted_ticket',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_ticket';
    protected $updatedField  = 'updated_ticket';
    protected $deletedField  = 'deleted_ticket';

    // Validation
    protected $validationRules      = [

        'pelapor_ticket' => 'required',
        'foto_ticket' => 'required',
        'status_ticket' => 'required',

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
