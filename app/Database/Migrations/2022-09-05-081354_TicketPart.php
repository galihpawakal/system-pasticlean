<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TicketPart extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_ticket_part' => [
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
            'part_ticket_part' => [
                'type' => 'varchar',
                'constraint' => '100',
            ],
            'harga_ticket_part' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'qty_ticket_part' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'total_ticket_part' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'noted_ticket_part' => [
                'type' => 'text',
            ],
            'created_ticket_part' => [
                'type' => 'datetime',
            ],
            'updated_ticket_part' => [
                'type' => 'datetime',
            ],
            'deleted_ticket_part' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_ticket_part');
        $this->forge->addForeignKey('id_ticket', 'ticket', 'id_ticket');
        $this->forge->addForeignKey('id_user', 'user', 'id_user');

        $this->forge->createTable('ticket_part');
    }

    public function down()
    {
        $this->forge->dropTable('ticket_part');
    }
}
