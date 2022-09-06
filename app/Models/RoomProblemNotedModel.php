<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomProblemNotedModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'room_problem_noted';
    protected $primaryKey       = 'id_room_problem_noted';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_room_problem',
        'id_user',
        'noted_room_problem_noted',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_room_problem_noted';
    protected $updatedField  = 'updated_room_problem_noted';
    protected $deletedField  = 'deleted_room_problem_noted';

    // Validation
    protected $validationRules      = [
        'id_room_problem' => 'required',
        'id_user' => 'required',

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
