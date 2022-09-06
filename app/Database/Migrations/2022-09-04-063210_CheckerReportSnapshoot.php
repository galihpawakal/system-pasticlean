<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CheckerReportSnapshoot extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_checker_report_snapshoot' => [
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
            'id_snapshoot_checker' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'constraint' => '11',
            ],
            'foto_checker_report_snapshoot' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'noted_checker_report_snapshoot' => [
                'type' => 'text',
            ],
            'created_checker_report_snapshoot' => [
                'type' => 'datetime',
            ],
            'updated_checker_report_snapshoot' => [
                'type' => 'datetime',
            ],
            'deleted_checker_report_snapshoot' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_checker_report_snapshoot');
        $this->forge->addForeignKey('id_checker_report', 'checker_report', 'id_checker_report');
        $this->forge->addForeignKey('id_snapshoot_checker', 'snapshoot_checker', 'id_snapshoot_checker');

        $this->forge->createTable('checker_report_snapshoot');
    }

    public function down()
    {
        $this->forge->dropTable('checker_report_snapshoot');
    }
}
