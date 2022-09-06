<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ChecklistChecker extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_checklist_checker' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'auto_increment' => true,
                'constraint' => '11',
            ],
            'id_atm_checker' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'constraint' => '11',
            ],
            'nama_checklist_checker' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'status_foto_checklist_checker' => [
                'type' => 'enum',
                'constraint' => ['yes', 'no'],
            ],
            'noted_checklist_checker' => [
                'type' => 'text',
            ],
            'created_checklist_checker' => [
                'type' => 'datetime',
            ],
            'updated_checklist_checker' => [
                'type' => 'datetime',
            ],
            'deleted_checklist_checker' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_checklist_checker');
        $this->forge->addForeignKey('id_atm_checker', 'atm_checker', 'id_atm_checker');

        $this->forge->createTable('checklist_checker');
    }

    public function down()
    {
        $this->forge->dropTable('checklist_checker');
    }
}
