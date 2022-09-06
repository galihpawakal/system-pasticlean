<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CheckerReportAttach extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_checker_report_attach' => [
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
            'id_user' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'constraint' => '11',
            ],
            'file_checker_report_attach' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'noted_checker_report_attach' => [
                'type' => 'text',
            ],
            'created_checker_report_attach' => [
                'type' => 'datetime',
            ],
            'updated_checker_report_attach' => [
                'type' => 'datetime',
            ],
            'deleted_checker_report_attach' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_checker_report_attach');
        $this->forge->addForeignKey('id_checker_report', 'checker_report', 'id_checker_report');
        $this->forge->addForeignKey('id_user', 'user', 'id_user');

        $this->forge->createTable('checker_report_attach');
    }

    public function down()
    {
        $this->forge->dropTable('checker_report_attach');
    }
}
