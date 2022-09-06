<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomProblemModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'room_problem';
    protected $primaryKey       = 'id_room_problem';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_atm_lokasi',
        'id_user',
        'pelapor_room_problem',
        'foto_room_problem',
        'status_room_problem',
        'noted_room_problem',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_room_problem';
    protected $updatedField  = 'updated_room_problem';
    protected $deletedField  = 'deleted_room_problem';

    // Validation
    protected $validationRules      = [
        'pelapor_room_problem' => 'required',
        'foto_room_problem' => 'required',
        'status_room_problem' => 'required',
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
