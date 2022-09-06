<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserToken extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user_token' => [
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
            'token_user_token' => [
                'type' => 'text',
            ],
            'noted_user_token' => [
                'type' => 'text',
            ],
            'created_user_token' => [
                'type' => 'datetime',
            ],
            'updated_user_token' => [
                'type' => 'datetime',
            ],
            'deleted_user_token' => [
                'type' => 'datetime',
            ]
        ]);

        $this->forge->addPrimaryKey('id_user_token');
        $this->forge->addForeignKey('id_user', 'user', 'id_user');

        $this->forge->createTable('user_token');
    }

    public function down()
    {
        $this->forge->dropTable('user_token');
    }
}
