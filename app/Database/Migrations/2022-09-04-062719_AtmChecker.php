<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AtmChecker extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_atm_checker' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'auto_increment' => true,
                'constraint' => '11',
            ],
            'id_atm_ring' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'constraint' => '11',
            ],
            'nama_atm_checker' => [
                'type' => 'varchar',
                'constraint' => '255',
            ],
            'noted_atm_checker' => [
                'type' => 'text',
            ],
            'created_atm_checker' => [
                'type' => 'datetime',
            ],
            'updated_atm_checker' => [
                'type' => 'datetime',
            ],
            'deleted_atm_checker' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_atm_checker');
        $this->forge->addForeignKey('id_atm_ring', 'atm_ring', 'id_atm_ring');

        $this->forge->createTable('atm_checker');
    }

    public function down()
    {
        $this->forge->dropTable('atm_checker');
    }
}
