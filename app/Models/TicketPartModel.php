<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketPartModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tiket_part';
    protected $primaryKey       = 'id_tiket_part';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_ticket',
        'id_user',
        'part_ticket_part',
        'harga_ticket_part',
        'qty_ticket_part',
        'total_ticket_part',
        'noted_ticket_part',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_ticket_part';
    protected $updatedField  = 'updated_ticket_part';
    protected $deletedField  = 'deleted_ticket_part';

    // Validation
    protected $validationRules      = [
        'part_ticket_part' => 'required',
        'harga_ticket_part' => 'required',
        'qty_ticket_part' => 'required',
        'total_ticket_part' => 'required',

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
