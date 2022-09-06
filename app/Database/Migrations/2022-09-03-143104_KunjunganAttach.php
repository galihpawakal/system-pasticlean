<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KunjunganAttach extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kunjungan_attach' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'auto_increment' => true,
                'constraint' => '11',
            ],
            'id_kunjungan' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'constraint' => '11',
            ],
            'id_user' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'constraint' => '11',
            ],
            'file_kunjungan_attach' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'noted_kunjungan_attach' => [
                'type' => 'text',
            ],
            'created_kunjungan_attach' => [
                'type' => 'datetime',
            ],
            'updated_kunjungan_attach' => [
                'type' => 'datetime',
            ],
            'deleted_kunjungan_attach' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_kunjungan_attach');
        $this->forge->addForeignKey('id_kunjungan', 'kunjungan', 'id_kunjungan');
        $this->forge->addForeignKey('id_user', 'user', 'id_user');


        $this->forge->createTable('kunjungan_attach');
    }

    public function down()
    {
        $this->forge->dropTable('kunjungan_attach');
    }
}
