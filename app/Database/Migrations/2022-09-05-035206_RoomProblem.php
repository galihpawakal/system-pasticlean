<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RoomProblem extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_room_problem' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'auto_increment' => true,
                'constraint' => '11',
            ],
            'id_atm_lokasi' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'constraint' => '11',
            ],
            'id_user' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'constraint' => '11',
            ],
            'pelapor_room_problem' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'foto_room_problem' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'status_room_problem' => [
                'type' => 'enum',
                'constraint' => ['created', 'process', 'finish', 'cancel'],
            ],
            'noted_room_problem' => [
                'type' => 'text',
            ],
            'created_room_problem' => [
                'type' => 'datetime',
            ],
            'updated_room_problem' => [
                'type' => 'datetime',
            ],
            'deleted_room_problem' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_room_problem');
        $this->forge->addForeignKey('id_atm_lokasi', 'atm_lokasi', 'id_atm_lokasi');
        $this->forge->addForeignKey('id_user', 'user', 'id_user');

        $this->forge->createTable('room_problem');
    }

    public function down()
    {
        $this->forge->dropTable('room_problem');
    }
}
