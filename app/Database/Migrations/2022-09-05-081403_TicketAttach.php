<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TicketAttach extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_ticket_attach' => [
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
            'file_ticket_attach' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'noted_ticket_attach' => [
                'type' => 'text',
            ],
            'created_ticket_attach' => [
                'type' => 'datetime',
            ],
            'updated_ticket_attach' => [
                'type' => 'datetime',
            ],
            'deleted_ticket_attach' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_ticket_attach');
        $this->forge->addForeignKey('id_ticket', 'ticket', 'id_ticket');
        $this->forge->addForeignKey('id_user', 'user', 'id_user');

        $this->forge->createTable('ticket_attach');
    }

    public function down()
    {
        $this->forge->dropTable('ticket_attach');
    }
}
