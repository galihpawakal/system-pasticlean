<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CheckerReportChecklist extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_checker_report_cheklist' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'auto_increment' => true,
                'constraint' => '11',
            ],
            'id_checker_report' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'constraint' => '11',
            ],
            'id_checklist_checker' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'constraint' => '11',
            ],
            'status_checker_report_cheklist' => [
                'type' => 'enum',
                'constraint' => ['yes', 'no'],
            ],
            'foto_checker_report_cheklist' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'noted_checker_report_cheklist' => [
                'type' => 'text',
            ],
            'created_checker_report_cheklist' => [
                'type' => 'datetime',
            ],
            'updated_checker_report_cheklist' => [
                'type' => 'datetime',
            ],
            'deleted_checker_report_cheklist' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_checker_report_cheklist');
        $this->forge->addForeignKey('id_checker_report', 'checker_report', 'id_checker_report');
        $this->forge->addForeignKey('id_checklist_checker', 'checklist_checker', 'id_checklist_checker');

        $this->forge->createTable('checker_report_cheklist');
    }

    public function down()
    {
        $this->forge->dropTable('checker_report_cheklist');
    }
}
