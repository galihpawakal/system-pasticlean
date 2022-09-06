<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AtmProblemNoted extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_atm_problem_noted' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'auto_increment' => true,
                'constraint' => '11',
            ],
            'id_user' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'constraint' => '11',
            ],
            'id_atm_problem' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'constraint' => '11',
            ],
            'noted_atm_problem_noted' => [
                'type' => 'text',
            ],
            'created_atm_problem_noted' => [
                'type' => 'datetime',
            ],
            'updated_atm_problem_noted' => [
                'type' => 'datetime',
            ],
            'deleted_atm_problem_noted' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_atm_problem_noted');
        $this->forge->addForeignKey('id_user', 'user', 'id_user');
        $this->forge->addForeignKey('id_atm_problem', 'atm_problem', 'id_atm_problem');

        $this->forge->createTable('atm_problem_noted');
    }

    public function down()
    {
        $this->forge->dropTable('atm_problem_noted');
    }
}
