<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AuthGroupUser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_auth_group_user' => [
                'type' => 'int',
                'constraint' => '11',
                'unsigned' => TRUE,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type' => 'int',
                'constraint' => '11',
                'unsigned' => TRUE,
            ],
            'id_auth_group' => [
                'type' => 'int',
                'constraint' => '11',
                'unsigned' => TRUE,
            ],

            'noted_auth_group_user' => [
                'type' => 'text',
            ],
            'created_auth_group_user' => [
                'type' => 'datetime',
            ],
            'updated_auth_group_user' => [
                'type' => 'datetime',
            ],
            'deleted_auth_group_user' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_auth_group_user');
        $this->forge->addForeignKey('id_user', 'user', 'id_user');
        $this->forge->addForeignKey('id_auth_group', 'auth_group', 'id_auth_group');


        $this->forge->createTable('auth_group_user');
    }

    public function down()
    {
        $this->forge->dropTable('auth_group_user');
    }
}
