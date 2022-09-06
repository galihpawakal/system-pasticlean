<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserClient extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user_client' => [
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
            'kd_client_region_3' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'noted_user_client' => [
                'type' => 'text',
            ],
            'created_user_client' => [
                'type' => 'datetime',
            ],
            'updated_user_client' => [
                'type' => 'datetime',
            ],
            'deleted_user_client' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_user_client');
        $this->forge->addForeignKey('id_auth_group', 'auth_group', 'id_auth_group');
        $this->forge->addForeignKey('kd_client_region_3', 'client_region_3', 'kd_client_region_3');

        $this->forge->createTable('user_client');
    }

    public function down()
    {
        $this->forge->dropTable('user_client');
    }
}
