<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SnapshootChecker extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_snapshoot_checker' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'auto_increment' => true,
                'constraint' => '11',
            ],
            'id_atm_checker' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'constraint' => '11',
            ],
            'nama_snapshoot_checker' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'noted_snapshoot_checker' => [
                'type' => 'text',
            ],
            'created_snapshoot_checker' => [
                'type' => 'datetime',
            ],
            'updated_snapshoot_checker' => [
                'type' => 'datetime',
            ],
            'deleted_snapshoot_checker' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_snapshoot_checker');
        $this->forge->addForeignKey('id_atm_checker', 'atm_checker', 'id_atm_checker');

        $this->forge->createTable('snapshoot_checker');
    }

    public function down()
    {
        $this->forge->dropTable('snapshoot_checker');
    }
}
