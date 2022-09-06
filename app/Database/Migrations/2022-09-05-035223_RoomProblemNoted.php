<?php

namespace App\Database\Migrations\RoomProblemNoted;

use CodeIgniter\Database\Migration;

class RoomProblemNoted extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_room_problem_noted' => [
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
            'noted_room_problem_noted' => [
                'type' => 'text',
            ],
            'created_room_problem_noted' => [
                'type' => 'datetime',
            ],
            'updated_room_problem_noted' => [
                'type' => 'datetime',
            ],
            'deleted_room_problem_noted' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_room_problem_noted');
        $this->forge->addForeignKey('id_room_problem', 'room_problem', 'id_room_problem');
        $this->forge->addForeignKey('id_user', 'user', 'id_user');

        $this->forge->createTable('room_problem_noted');
    }

    public function down()
    {
        $this->forge->dropTable('room_problem_noted');
    }
}
