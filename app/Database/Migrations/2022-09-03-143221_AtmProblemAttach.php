<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AtmProblemAttach extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_atm_problem_attach' => [
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
            'file_atm_problem_attach' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'noted_atm_problem_attach' => [
                'type' => 'text',
            ],
            'created_atm_problem_attach' => [
                'type' => 'datetime',
            ],
            'updated_atm_problem_attach' => [
                'type' => 'datetime',
            ],
            'deleted_atm_problem_attach' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_atm_problem_attach');
        $this->forge->addForeignKey('id_user', 'user', 'id_user');
        $this->forge->addForeignKey('id_atm_problem', 'atm_problem', 'id_atm_problem');

        $this->forge->createTable('atm_problem_attach');
    }

    public function down()
    {
        $this->forge->dropTable('atm_problem_attach');
    }
}
