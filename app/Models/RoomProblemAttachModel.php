<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomProblemAttachModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'room_problem_attach';
    protected $primaryKey       = 'id_room_problem_attach';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_room_problem',
        'id_user',
        'file_room_problem_attach',
        'noted_room_problem_attach',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_room_problem_attach';
    protected $updatedField  = 'updated_room_problem_attach';
    protected $deletedField  = 'deleted_room_problem_attach';

    // Validation
    protected $validationRules      = [
        'file_room_problem_attach' => 'required',
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
