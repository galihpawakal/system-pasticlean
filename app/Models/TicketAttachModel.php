<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketAttachModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ticket_attach';
    protected $primaryKey       = 'id_ticket_attach';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_ticket',
        'id_user',
        'file_ticket_attach',
        'noted_ticket_attach',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_ticket_attach';
    protected $updatedField  = 'updated_ticket_attach';
    protected $deletedField  = 'deleted_ticket_attach';

    // Validation
    protected $validationRules      = [
        'file_ticket_attach' => 'required',
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
