<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CheckerReport extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_checker_report' => [
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
            'petugas_checker_report' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'tgl_checker_report' => [
                'type' => 'date',
            ],
            'status_checker_report' => [
                'type' => 'enum',
                'constraint' => ['process', 'clean', 'passed'],
            ],
            'noted_checker_report' => [
                'type' => 'text',
            ],
            'created_checker_report' => [
                'type' => 'datetime',
            ],
            'updated_checker_report' => [
                'type' => 'datetime',
            ],
            'deleted_checker_report' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_checker_report');
        $this->forge->addForeignKey('id_atm_checker', 'atm_checker', 'id_atm_checker');
        $this->forge->addForeignKey('id_atm_lokasi', 'atm_lokasi', 'id_atm_lokasi');
        $this->forge->addForeignKey('id_user', 'user', 'id_user');

        $this->forge->createTable('checker_report');
    }

    public function down()
    {
        $this->forge->dropTable('checker_report');
    }
}
