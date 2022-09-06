<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ticket extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_ticket' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'auto_increment' => true,
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
            'pelapor_ticket' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'foto_ticket' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'status_ticket' => [
                'type' => 'enum',
                'constraint' => ['created', 'process', 'finish', 'cancel'],
            ],
            'noted_ticket' => [
                'type' => 'text',
            ],
            'created_ticket' => [
                'type' => 'datetime',
            ],
            'updated_ticket' => [
                'type' => 'datetime',
            ],
            'deleted_ticket' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_ticket');
        $this->forge->addForeignKey('id_atm_lokasi', 'atm_lokasi', 'id_atm_lokasi');
        $this->forge->addForeignKey('id_user', 'user', 'id_user');

        $this->forge->createTable('ticket');
    }

    public function down()
    {
        $this->forge->dropTable('ticket');
    }
}
