<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AuthGroupPermission extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_auth_group_permission' => [
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
            'id_auth_permission' => [
                'type' => 'int',
                'constraint' => '11',
                'unsigned' => TRUE,
            ],
            'noted_auth_group_permission' => [
                'type' => 'text',
            ],
            'created_auth_group_permission' => [
                'type' => 'datetime',
            ],
            'updated_auth_group_permission' => [
                'type' => 'datetime',
            ],
            'deleted_auth_group_permission' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_auth_group_permission');
        $this->forge->addForeignKey('id_auth_group', 'auth_group', 'id_auth_group');
        $this->forge->addForeignKey('id_auth_permission', 'auth_permission', 'id_auth_permission');

        $this->forge->createTable('auth_group_permission');
    }

    public function down()
    {
        $this->forge->dropTable('auth_group_permission');
    }
}
