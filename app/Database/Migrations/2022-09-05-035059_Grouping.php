<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Grouping extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_grouping' => [
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
            'id_atm_lokasi' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'constraint' => '11',
            ],
            'noted_grouping' => [
                'type' => 'text',
            ],
            'created_grouping' => [
                'type' => 'datetime',
            ],
            'updated_grouping' => [
                'type' => 'datetime',
            ],
            'deleted_grouping' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_grouping');
        $this->forge->addForeignKey('id_user', 'user', 'id_user');
        $this->forge->addForeignKey('id_atm_lokasi', 'atm_lokasi', 'id_atm_lokasi');

        $this->forge->createTable('grouping');
    }

    public function down()
    {
        $this->forge->dropTable('grouping');
    }
}
