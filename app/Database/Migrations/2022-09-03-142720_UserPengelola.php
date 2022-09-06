<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserPengelola extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user_pengelola' => [
                'type' => 'int',
                'constraint' => '11',
                'unsigned' => TRUE,
                'auto_increment' => true,
            ],
            'id_auth_group' => [
                'type' => 'int',
                'constraint' => '11',
                'unsigned' => TRUE,
            ],
            'kd_pengelola_region_3' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'noted_user_pengelola' => [
                'type' => 'text',
            ],
            'created_user_pengelola' => [
                'type' => 'datetime',
            ],
            'updated_user_pengelola' => [
                'type' => 'datetime',
            ],
            'deleted_user_pengelola' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_user_pengelola');
        $this->forge->addForeignKey('id_auth_group', 'auth_group', 'id_auth_group');
        $this->forge->addForeignKey('kd_pengelola_region_3', 'pengelola_region_3', 'kd_pengelola_region_3');

        $this->forge->createTable('user_pengelola');
    }

    public function down()
    {
        $this->forge->dropTable('user_pengelola');
    }
}
