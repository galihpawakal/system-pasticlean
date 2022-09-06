<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AtmAuditAttach extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_atm_audit_attach' => [
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
            'id_atm_audit' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'constraint' => '11',
            ],
            'file_atm_audit_attach' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'noted_atm_audit_attach' => [
                'type' => 'text',
            ],
            'created_atm_audit_attach' => [
                'type' => 'datetime',
            ],
            'updated_atm_audit_attach' => [
                'type' => 'datetime',
            ],
            'deleted_atm_audit_attach' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_atm_audit_attach');
        $this->forge->addForeignKey('id_user', 'user', 'id_user');
        $this->forge->addForeignKey('id_atm_audit', 'atm_audit', 'id_atm_audit');

        $this->forge->createTable('atm_audit_attach');
    }

    public function down()
    {
        $this->forge->dropTable('atm_audit_attach');
    }
}
