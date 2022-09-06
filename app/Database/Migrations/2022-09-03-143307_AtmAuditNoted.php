<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AtmAuditNoted extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_atm_audit_noted' => [
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
            'noted_atm_audit_noted' => [
                'type' => 'text',
            ],
            'created_atm_audit_noted' => [
                'type' => 'datetime',
            ],
            'updated_atm_audit_noted' => [
                'type' => 'datetime',
            ],
            'deleted_atm_audit_noted' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_atm_audit_noted');
        $this->forge->addForeignKey('id_user', 'user', 'id_user');
        $this->forge->addForeignKey('id_atm_audit', 'atm_audit', 'id_atm_audit');

        $this->forge->createTable('atm_audit_noted');
    }

    public function down()
    {
        $this->forge->dropTable('atm_audit_noted');
    }
}
