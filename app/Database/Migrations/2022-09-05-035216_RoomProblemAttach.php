<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RoomProblemAttach extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_room_problem_attach' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'auto_increment' => true,
                'constraint' => '11',
            ],
            'id_room_problem' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'constraint' => '11',
            ],
            'id_user' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'constraint' => '11',
            ],
            'file_room_problem_attach' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'noted_room_problem_attach' => [
                'type' => 'text',
            ],
            'created_room_problem_attach' => [
                'type' => 'datetime',
            ],
            'updated_room_problem_attach' => [
                'type' => 'datetime',
            ],
            'deleted_room_problem_attach' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_room_problem_attach');
        $this->forge->addForeignKey('id_room_problem', 'room_problem', 'id_room_problem');
        $this->forge->addForeignKey('id_user', 'user', 'id_user');

        $this->forge->createTable('room_problem_attach');
    }

    public function down()
    {
        $this->forge->dropTable('room_problem_attach');
    }
}
