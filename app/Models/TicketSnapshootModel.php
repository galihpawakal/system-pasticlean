<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketSnapshootModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ticket_snapshoot';
    protected $primaryKey       = 'id_ticket_snapshoot';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_ticket',
        'id_user',
        'foto_ticket_snapshoot',
        'noted_ticket_snapshoot',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_ticket_snapshoot';
    protected $updatedField  = 'updated_ticket_snapshoot';
    protected $deletedField  = 'deleted_ticket_snapshoot';

    // Validation
    protected $validationRules      = [
        'foto_ticket_noted' => 'required',
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
