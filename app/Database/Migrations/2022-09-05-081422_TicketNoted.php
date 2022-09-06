<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TicketNoted extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_ticket_noted' => [
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
            'noted_ticket_noted' => [
                'type' => 'text',
            ],
            'created_ticket_noted' => [
                'type' => 'datetime',
            ],
            'updated_ticket_noted' => [
                'type' => 'datetime',
            ],
            'deleted_ticket_noted' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_ticket_noted');
        $this->forge->addForeignKey('id_ticket', 'ticket', 'id_ticket');
        $this->forge->addForeignKey('id_user', 'user', 'id_user');

        $this->forge->createTable('ticket_noted');
    }

    public function down()
    {
        $this->forge->dropTable('ticket_noted');
    }
}
