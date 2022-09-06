<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AuthPermission extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_auth_permission' => [
                'type' => 'int',
                'constraint' => '11',
                'unsigned' => TRUE,
                'auto_increment' => true,
            ],
            'nama_auth_permission' => [
                'type' => 'varchar',
                'constraint' => '100'
            ],
            'noted_auth_permission' => [
                'type' => 'text',
            ],
            'created_auth_permission' => [
                'type' => 'datetime',
            ],
            'updated_auth_permission' => [
                'type' => 'datetime',
            ],
            'deleted_auth_permission' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_auth_permission');

        $this->forge->createTable('auth_permission');
    }

    public function down()
    {
        $this->forge->dropTable('auth_permission');
    }
}
