<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TicketSnapshoot extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_ticket_snapshoot' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'auto_increment' => true,
                'constraint' => '11',
            ],
            'id_ticket' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'constraint' => '11',
            ],
            'id_user' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'constraint' => '11',
            ],
            'foto_ticket_snapshoot' => [
                'type' => 'varchar',
                'constraint' => '100',
            ],
            'noted_ticket_snapshoot' => [
                'type' => 'text',
            ],
            'created_ticket_snapshoot' => [
                'type' => 'datetime',
            ],
            'updated_ticket_snapshoot' => [
                'type' => 'datetime',
            ],
            'deleted_ticket_snapshoot' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_ticket_snapshoot');
        $this->forge->addForeignKey('id_ticket', 'ticket', 'id_ticket');
        $this->forge->addForeignKey('id_user', 'user', 'id_user');

        $this->forge->createTable('ticket_snapshoot');
    }

    public function down()
    {
        $this->forge->dropTable('ticket_snapshoot');
    }
}
