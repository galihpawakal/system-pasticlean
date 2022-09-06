<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TicketDetail extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_ticket_detail' => [
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
            'jenis_ticket_detail' => [
                'type' => 'enum',
                'constraint' => ['mechanical', 'sipil', 'electrical', 'ac'],
            ],
            'noted_ticket_detail' => [
                'type' => 'text',
            ],
            'created_ticket_detail' => [
                'type' => 'datetime',
            ],
            'updated_ticket_detail' => [
                'type' => 'datetime',
            ],
            'deleted_ticket_detail' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_ticket_detail');
        $this->forge->addForeignKey('id_ticket', 'ticket', 'id_ticket');
        $this->forge->addForeignKey('id_user', 'user', 'id_user');

        $this->forge->createTable('ticket_detail');
    }

    public function down()
    {
        $this->forge->dropTable('ticket_detail');
    }
}
