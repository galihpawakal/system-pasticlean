<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Schedule extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_schedule' => [
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
            'tgl_schedule' => [
                'type' => 'date',
            ],
            'value_schedule' => [
                'type' => 'enum',
                'constraint' => ['masuk', 'alfa', 'izin', 'sakit', 'telat', 'libur'],
            ],
            'noted_schedule' => [
                'type' => 'text',
            ],
            'created_schedule' => [
                'type' => 'datetime',
            ],
            'updated_schedule' => [
                'type' => 'datetime',
            ],
            'deleted_schedule' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_schedule');
        $this->forge->addForeignKey('id_user', 'user', 'id_user');

        $this->forge->createTable('schedule');
    }

    public function down()
    {
        $this->forge->dropTable('schedule');
    }
}
