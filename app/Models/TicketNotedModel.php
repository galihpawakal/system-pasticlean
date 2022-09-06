<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketNotedModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ticket_noted';
    protected $primaryKey       = 'id_ticket_noted';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_ticket',
        'id_user',
        'noted_ticket_noted',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_ticket_noted';
    protected $updatedField  = 'updated_ticket_noted';
    protected $deletedField  = 'deleted_ticket_noted';

    // Validation
    protected $validationRules      = [
        'noted_ticket_noted' => 'required',

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
